<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Notifications\RequestNotification;
use App\Category;
use App\RequestDB;
use App\Ictteam;
class Notifications extends Controller
{
   public function notifyRequest( $req){
     $directors=User::where( function($query){
                             $query->where('role',1)
                                   ->where('isApproved','1');
                           } )->get();
        $notification=auth::user();
        $req->title=Category::where('id',$req->title)->value('title');
        foreach ($directors as $director ) {
            $director->notify(new RequestNotification($notification,$req));
        }

    return ;
   }
   public function notifyFeedback($req){
     $this->admin=$req->admin;
     $this->team=$req->team;
      if($this->team){
           $administrators=User::where( function($query){
                                   $query->where('role',1)
                                         ->orWhere('id',$this->admin)
                                         ->orWhere('team',$this->team);
                                 })->where('isApproved','1')->get();
        }
        else{
          $administrators=User::where( function($query){
                                  $query->where('role',1)
                                        ->orWhere('id',$this->admin);
                                })->where('isApproved','1')->get();
        }
        $notification=auth::user();
        $req->title=Category::where('id',$req->title)->value('title');
        $req->message=$req->feedback;

        $req->sendTime=Carbon::now();
        $i=0;
        foreach ($administrators as $administrator ) {
              $administrator->notify(new RequestNotification($notification,$req));
              $i++;
        }

     return $i;
   }
   public function notifyAssign($req){
     $this->admin=$req->admin;
     $this->team=$req->team;
     if($this->admin && $this->team){
     $administrators=User::where( function($query){
                             $query->where('id',$this->admin)
                                   ->orWhere('team',$this->team);
                           } )->where('isApproved','1')->get();
        }
    elseif ($this->admin) {
      $administrators=User::where('id',$this->admin)->where('isApproved','1')->get();
    }
    elseif ($this->team) {
      $administrators=User::where('team',$this->team)->where('isApproved','1')->get();
    }else {
      // code...
    }
        $notification=User::find($req->sender);
        $req->title=Category::where('id',$req->title)->value('title');
        $req->sendTime=Carbon::now();
        foreach ($administrators as $administrator ) {
              $administrator->notify(new RequestNotification($notification,$req));
        }
     return ;
   }
    public function notifications()
      {
              $notification=auth()->user()->unreadNotifications();
              $total=$notification->count();
          return response()->json(auth()->user()->unreadNotifications()->get());
      }
  public function read(Request $req){
    if(!$req->id){
      return redirect()->back();
    }
    $requests=collect();
    $request="";

    foreach ($req->id as $key => $value) {
      $request=RequestDB::find($value);
      if($request->admin){
       $request->firstName=User::where('id',$request->admin)->value('firstName');
       $request->middleName=User::where('id',$request->admin)->value('middleName');
       }

      if($request->team){
      $request->team=Ictteam::where('id',$request->team)->value('teamName');
       }
      $title=$request->title;
      $request->title=Category::where("id",$title)->value('title');

     $request->administrators=User::where('role',2)->Where('isApproved','1')->get();
     $request->teams=Ictteam::all();
     $request=$requests->push($request);

    }
  if($request){
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
    return view('notification',['request'=>$request,'year'=>$year,'month'=>$month,'yourself'=>$your,"withteam"=>$team,'total'=>$total]);
  }
  return redirect()->route('home');
  }
  public function activate(Request $req){
     $user=User::where('emailToken',$req->token)->first();
     if($user){
       $user->activation=1;
       $user->save();
     }
    return view('activateSuccesfull',['user'=>$user]);
  }
}
