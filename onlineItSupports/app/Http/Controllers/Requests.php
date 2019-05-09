<?php
namespace App\Http\Controllers;
use Auth;
use App\RequestDB;
use Carbon\Carbon;
use App\User;
use App\Department;
use App\Direction;
use App\Floor;
use App\Ictteam;
use App\Category;
use App\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Notifications;
use Illuminate\Support\Facades\Validator;
class Requests extends Controller
{
  protected function validateRequest(array $data)
  {
      return Validator::make($data, [
        'title' => 'required',
        'body' => 'max:255',
      ]);
  }
  	public function send(Request $req){
      $validate=$this->validateRequest($req->all())->validate();
		 $request=new RequestDB;
		 $request->title=$req->title;
		 $request->message=$req->body;
		 $request->sendTime=Carbon::now();
		 $request->sender=Auth::user()->id;
		 $request->save();
     $notification=new Notifications;
     $notification->notifyRequest($request);

		 return redirect()->action("loginEmployee@login");
	}

	public function comment(Request $req){
     $request=RequestDB::find($req->id);
     if($request->feedback != $req->comment ){
       $request->feedback=$req->comment;
       $request->save();
       $notification=new Notifications;
       $notification->notifyFeedback($request);
     }
     return "comment";
	}
  public function feedback(Request $req){
     $request=RequestDB::find($req->id);
     $feedback=$request->feedback;
     return response()->json(['feedback'=>$feedback]);
  }
	public function done(Request $req){
		$request=RequestDB::find($req->id);
		$request->status=intval($req->status);
    $request->resolvedTime=Carbon::now();
		$request->save();
       return "done";
	}
  public function assign(Request $req){
     $request=RequestDB::find($req->id);
     $request->status=1;
     $request->seenTime=Carbon::now();
     $adminFirstName="";
     $adminMiddleName="";
     $team="";

     if(intval($req->team)){
       $request->team=intval($req->team);
       $team=Ictteam::where('id',$req->team)->value('teamName');

     }
     if(intval($req->admin)){
            $request->admin=intval($req->admin);
            $adminFirstName=User::where('id',$req->admin)->value('firstName');
            $adminMiddleName=User::where('id',$req->admin)->value('middleName');
        }
        $request->save();

            $notification=new Notifications;
            $notification->notifyAssign($request);

    return response()->json(['team'=>$team,'firstName'=>$adminFirstName,'middleName'=>$adminMiddleName]);
  }
  public function sender(Request $req){
      $profile=User::find(intval($req->sender));
          $dep=$profile->department;
          $profile->department=Department::where('id',$dep)->value('departmentName');
          $dir=Department::where('id',$dep)->value('direction');
          $profile->direction=Direction::where('id',$dir)->value('direction');
          $flo=Department::where('id',$dep)->value('floor');
          $profile->floor=Floor::where('id',$flo)->value('floor');
      return response()->json([$profile]);
  }
   public function count(Request $req){
     $carbon = Carbon::today();
    $timestamp = $carbon->timestamp;
    $format = $carbon->format('Y-m-d H:i:s');
    $year = $carbon->year;
    $month=$carbon->month;
     $req1=RequestDB::where('status','=',2)->where(function($query){
            $query->where('admin',Auth::User()->id)
            ->whereYear('resolvedTime', '=', date('Y'))
            ->whereMonth('resolvedTime', '=', date('m'));})->get();
    $req2=RequestDB::where('status','=',2)->where(function($query){
                   $query->Where('team',User::where('id',Auth::User()->id)->value('team'))
                         ->whereYear('resolvedTime', '=', date('Y'))
                         ->whereMonth('resolvedTime', '=', date('m'));})->get();
          $your=$req1->count();
           $team=$req2->count();
           $total=$your+$team;

     return response()->json(['total'=>$total,'yourself'=>$your,'withteam'=>$team,'year'=>$year,'month'=>$month]);
   }
   public function unResolved(Request $req){
     $role=Auth::user()->role;
     if($role==1){
       $request=RequestDB::where("status",'!=',2)->get();
       foreach ($request as $value) {
          if($value->admin){
           $value->firstName=User::where('id',$value->admin)->value('firstName');
           $value->middleName=User::where('id',$value->admin)->value('middleName');
           }

          if($value->team){
          $value->team=Ictteam::where('id',$value->team)->value('teamName');
           }
          $title=$value->title;
          $value->title=Category::where("id",$title)->value('title');
          $value->administrators=User::where('role',2)->Where('isApproved','1')->get();
          $value->teams=Ictteam::all();
       }

      return view('unresolved',['request'=>$request]);
     }elseif ($role==2) {

       $request=RequestDB::where('status','!=',2)->where(function($query){
              $query->where('admin',Auth::User()->id)
                    ->orWhere('team',Auth::User()->team);
            })->get();
            foreach ($request as $value) {
               $title=$value->title;
               $value->title=Category::where("id",$title)->value('title');
            }
            $carbon = Carbon::today();
           $timestamp = $carbon->timestamp;
           $format = $carbon->format('Y-m-d H:i:s');
           $year = $carbon->year;
           $month=$carbon->month;
            $req1=RequestDB::where('status','=',2)->where(function($query){
                   $query->where('admin',Auth::User()->id)
                   ->whereYear('resolvedTime', '=', date('Y'))
                   ->whereMonth('resolvedTime', '=', date('m'));})->get();
           $req2=RequestDB::where('status','=',2)->where(function($query){
                          $query->Where('team',User::where('id',Auth::User()->id)->value('team'))
                                ->whereYear('resolvedTime', '=', date('Y'))
                                ->whereMonth('resolvedTime', '=', date('m'));})->get();
                 $your=$req1->count();
                  $team=$req2->count();
                  $total=$your+$team;
       return view('unresolved',['request'=>$request,'year'=>$year,'month'=>$month,'yourself'=>$your,"withteam"=>$team,'total'=>$total]);
     }elseif ($role==3) {
       $request=RequestDB::where("sender",Auth::User()->id)
                            ->where("status",'!=',2)->get();

       foreach ($request as $value) {
          $title=$value->title;
          $value->title=Category::where("id",$title)->value('title');
          $status=$value->status;
          $value->status=Status::where('id',$status)->value('status');
       }
      return view('unresolved',['request'=>$request]);
     }else {
      return redirect()->route('home');
     }

   }

}
