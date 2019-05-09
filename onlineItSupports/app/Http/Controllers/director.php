<?php

namespace App\Http\Controllers;
use App\User;
use App\Ictteam;
use App\RequestDB;
use App\Department;
use App\Role;
use App\Direction;
use App\Floor;
use App\Status;
use App\Category;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class director extends Controller
{
   public function approve(Request $req){

       $employee=User::find($req->id);
       $employee->isApproved='1';
       if(intval($req->team)){
         $employee->team=intval($req->team);
       }
       $employee->save();
      return $employee;
   }
  public function cancel(Request $req){
       $employee=User::find($req->id);
       $employee->delete();
   	return $employee;
   }
   public function delete(Request $req){
     $employee=User::find($req->id);
     $employee->delete();
      return $employee;
   }
   public function employee(Request $req){
     $users=User::where('role',3)->where('isApproved','1')->paginate(10);
     foreach($users as $user){
       $dep=$user->department;
       $user->department=Department::where('id',$dep)->value('departmentName');

     }
     return view('employee',['employees'=>$users]);
   }
   public function searchEmployee(Request $req){
     $this->req=$req;
     $this->dep=Department::where('departmentName',$this->req->search)->value('id');
     $users=User::where('role',3)
                  ->where('isApproved','1')
                  ->where(function($query){
                    $query->where('firstName','like','%'.$this->req->search.'%')
                          ->orWhere('middleName','like','%'.$this->req->search.'%')
                          ->orWhere('email','like','%'.$this->req->search.'%')
                          ->orWhere('department','like',$this->dep?$this->dep:'none');})->paginate(10);
     foreach($users as $user){
       $dep=$user->department;
       $user->department=Department::where('id',$dep)->value('departmentName');

     }
     return view('employee',['employees'=>$users]);
   }

   public function administrators(Request $req){
     $users=User::where('role',2)->where('isApproved','1')->paginate(10);
     foreach($users as $user){
       $this->id=$user->id;

       $dep=$user->department;
       $this->team=$user->team;

       $user->department=Department::where('id',$dep)->value('departmentName');
       $user->team=Ictteam::where('id',$this->team)->value('teamName');

       $req1=RequestDB::where('status','=',2)->where(function($query){

              $query->where('admin',$this->id)
              ->orWhere('team',$this->team)
              ->whereYear('resolvedTime', '=', date('Y'))
              ->whereMonth('resolvedTime', '=', date('m'));})->get();
          $user->total=$req1->count();
     }
     return view('administrators',['administrators'=>$users]) ;
   }
   public function searchAdministrator(Request $req){
     $this->req=$req;
     $this->depId=Department::where('departmentName','like',$this->req->search)->value('id');
     $this->teamId=Ictteam::where('teamName',$this->req->search)->value('id');
     $users=User::where('role',2)
                  ->where('isApproved','1')
                  ->where(function($query){
                           $query->where('firstName','like','%'.$this->req->search.'%')
                                 ->orWhere('middleName','like','%'.$this->req->search.'%')
                                 ->orWhere('email','like','%'.$this->req->search.'%')
                                 ->orWhere('team','like',$this->teamId?$this->teamId:'none')
                                 ->orWhere('department','like',$this->depId?$this->depId:'none');})->paginate(10);
     foreach($users as $user){
       $this->id=$user->id;

       $dep=$user->department;
       $this->team=$user->team;

       $user->department=Department::where('id',$dep)->value('departmentName');
       $user->team=Ictteam::where('id',$this->team)->value('teamName');

       $req1=RequestDB::where('status','=',2)->where(function($query){
              $query->where('admin',$this->id)
              ->orWhere('team',$this->team)
              ->whereYear('resolvedTime', '=', date('Y'))
              ->whereMonth('resolvedTime', '=', date('m'));})->get();
          $user->total=$req1->count();
     }
     return view('administrators',['administrators'=>$users]) ;
   }
   public function deleteUser(Request $req){
     $user=User::find($req->id);
     $user->delete();
     return "deleteUser";
   }
   public function deleteSpamUser(Request $req){
     $ides=[];
     foreach($req->checkedIdes as $id){
         $user=User::find($id);
         $user->delete();
         $ides[]=$user->id;
      }
     return $ides;
   }
   public function UnrealEmailAccount(){
      $users=User::where('activation',0)->paginate(6);
      foreach($users as $user){
        $user->role=Role::where('id',$user->role)->value('roleName');
        $user->department=Department::where('id',$user->department)->value('departmentName');
      }
     return view('UnrealEmailAccount',['users'=>$users]);
   }
   function requests(Request $req){
     $request=RequestDB::paginate(6);
     foreach($request as $reqs){
       $reqs->senderFirstName=User::where('id',$reqs->sender)->value('firstName');
       $reqs->senderMiddleName=User::where('id',$reqs->sender)->value('middleName');
       $reqs->adminFirstName=User::where('id',$reqs->admin)->value('firstName');
       $reqs->adminMiddleName=User::where('id',$reqs->admin)->value('middleName');
       $reqs->team=Ictteam::where('id',$reqs->team)->value('teamName');
       $dep=User::where('id',$reqs->sender)->value('department');
       $reqs->senderDepartment=Department::where('id',$dep)->value('departmentName');
       $floor=Department::where('id',$dep)->value('floor');
       $reqs->senderFloor=Floor::where('id',$floor)->value('floor');
       $dir=Department::where('id',$dep)->value('direction');
       $reqs->senderDirection=Direction::where('id',$dir)->value('direction');
       $status=$reqs->status;
       $reqs->status=Status::where('id',$status)->value('status');
        $title=$reqs->title;
       $reqs->title=Category::where('id',$title)->value('title');

     }
     return view("requests",['requests'=>$request]);
   }
   public function searchRequest(Request $req){
     $this->req=$req;
     $this->splitName = explode(' ', $req->search);
     $this->status=Status::where('status',$req->search)->value('id');
     $this->title=Category::where('title',$req->search)->value('id');
     $this->teamId=Ictteam::where('teamName',$req->search)->value('id');
     $this->userId=User::where('isApproved','1')
                       ->where(function($query){
                                $query->where('firstName','like','%'.$this->splitName[0].'%')
                                      ->orWhere('middleName','like','%'.$this->splitName[0].'%')
                                      ->orWhere('email','like','%'.$this->req->search.'%');})->value('id');
      if($this->userId){
        $this->userId=User::where('isApproved','1')
                          ->where(function($query){
                                   $query->where('firstName','like','%'.$this->splitName[0].'%')
                                         ->orWhere('middleName','like','%'.$this->splitName[0].'%')
                                         ->orWhere('email','like','%'.$this->req->search.'%');})->pluck('id');
      }
     $request=RequestDB::where(function($query){
                    $query->where('title',$this->title?$this->title:'none')
                          ->orWhere('status','like',$this->status?$this->status:'none')
                          ->orWhere('team','like',$this->teamId?$this->teamId:'none')
                          ->orWhere('admin','like',$this->userId?$this->userId:'none')
                          ->orWhere('sender','like',$this->userId?$this->userId:'none');
     })->paginate(6);
     foreach($request as $reqs){
       $reqs->senderFirstName=User::where('id',$reqs->sender)->value('firstName');
       $reqs->senderMiddleName=User::where('id',$reqs->sender)->value('middleName');
       $reqs->adminFirstName=User::where('id',$reqs->admin)->value('firstName');
       $reqs->adminMiddleName=User::where('id',$reqs->admin)->value('middleName');
       $reqs->team=Ictteam::where('id',$reqs->team)->value('teamName');
       $dep=User::where('id',$reqs->sender)->value('department');
       $reqs->senderDepartment=Department::where('id',$dep)->value('departmentName');
       $floor=Department::where('id',$dep)->value('floor');
       $reqs->senderFloor=Floor::where('id',$floor)->value('floor');
       $dir=Department::where('id',$dep)->value('direction');
       $reqs->senderDirection=Direction::where('id',$dir)->value('direction');
       $status=$reqs->status;
       $reqs->status=Status::where('id',$status)->value('status');
        $title=$reqs->title;
       $reqs->title=Category::where('id',$title)->value('title');

     }
     return view("requests",['requests'=>$request]);

   }
   public function deleteRequest(Request $req){
     $user=RequestDB::find($req->id);
     $user->delete();
     return "deleteRequest";
   }
 public function role(Request $req){
      $role=Role::paginate(10);
   return view('admin.role',['role'=>$role]);
 }
   public function addRole(Request $req){
     $role=new Role;
     $role->roleName=$req->role;
     $role->save();
     return response()->json([$role]) ;
   }
   public function editRole(Request $req){
     $role=Role::find($req->id);
     $role->roleName=$req->role;
     $role->save();
     return response()->json([$role]);
   }
   public function deleteRole(Request $req){
     $role=Role::find($req->id)->delete();
     return response()->json(['id'=>$req->id]);
   }
public function department(Request $req){
  $department=Department::paginate(10);
  foreach($department as $dep){
    $floor=$dep->floor;
    $dep->floId=$floor;
    $dep->floor=Floor::where('id',$floor)->value('floor');
    $direction=$dep->direction;
    $dep->dirId=$direction;
    $dep->direction=Direction::where('id',$direction)->value('direction');
  }
  $directiones=Direction::pluck('id','direction');
  $floores=Floor::pluck('id','floor');
  return view('admin.department',['department'=>$department,'directiones'=>$directiones,'floores'=>$floores]);
}
   public function addDepartment(Request $req){
     $deps=new Department;
     $deps->departmentName=$req->department;
     $deps->floor=intval($req->floor);
     $deps->direction=intval($req->direction);
     $deps->save();
       $floor=$deps->floor;
       $deps->flo=Floor::where('id',$floor)->value('floor');
       $direction=$deps->direction;
       $deps->dir=Direction::where('id',$direction)->value('direction');
     return response()->json([$deps]) ;
   }
   public function editDepartment(Request $req){
     $deps=Department::find($req->id);
     $deps->departmentName=$req->department;
     $deps->floor=intval($req->floor);
     $deps->direction=intval($req->direction);
     $deps->save();
     $floor=$deps->floor;
     $deps->flo=Floor::where('id',$floor)->value('floor');
     $direction=$deps->direction;
     $deps->dir=Direction::where('id',$direction)->value('direction');
     return response()->json([$deps]);
   }
   public function deleteDepartment(Request $req){
     $dep=Department::find($req->id)->delete();
     return response()->json(['id'=>$req->id]);
   }
 public function category(Request $req){
   $category=Category::paginate(10);
   return view('admin.category',['category'=>$category]);
 }
   public function addCategory(Request $req){
     $cat=new Category;
     $cat->title=$req->category;
     $cat->save();
     return response()->json([$cat]) ;
   }
   public function editCategory(Request $req){
     $cat=Category::find($req->id);
     $cat->title=$req->category;
     $cat->save();
     return response()->json([$cat]);
   }
   public function deleteCategory(Request $req){
     $cat=Category::find($req->id)->delete();
     return response()->json(['id'=>$req->id]);
   }
   public function floor(Request $req){
     $floor=Floor::paginate(10);
     return view('admin.floor',['floor'=>$floor]);
   }
   public function addFloor(Request $req){
     $floor=new Floor;
     $floor->floor=$req->floor;
     $floor->save();
     return response()->json([$floor]);
   }
   public function editFloor(Request $req){
     $floor=Floor::find($req->id);
     $floor->floor=$req->floor;
     $floor->save();
     return response()->json([$floor]);
   }
   public function deleteFloor(Request $req){
     $floor=Floor::find($req->id)->delete();
     return response()->json(['id'=>$req->id]);
   }
   public function direction(Request $req){
     $direction=Direction::paginate(10);
     return view('admin.direction',['direction'=>$direction]);
   }
   public function addDirection(Request $req){
     $direction=new Direction;
     $direction->direction=$req->direction;
     $direction->save();
     return response()->json([$direction]);
   }
   public function editDirection(Request $req){
     $direction=Direction::find($req->id);
     $direction->direction=$req->direction;
     $direction->save();
     return response()->json([$direction]);
   }
   public function deleteDirection(Request $req){
     $direction=Direction::find($req->id)->delete();
     return response()->json(['id'=>$req->id]);
   }
   public function team(Request $req){
     $team=Ictteam::paginate(10);
     return view('admin.team',['teams'=>$team]);
   }
   public function addTeam(Request $req){
     $team=new Ictteam;
      $team->teamName=$req->team;
     $team->save();
     return response()->json([$team]);
   }
   public function editTeam(Request $req){
     $team=Ictteam::find($req->id);
     $team->teamName=$req->team;
     $team->save();
     return response()->json([$team]);
   }
   public function deleteTeam(Request $req){
     $team=$team=Ictteam::find($req->id)->delete();
     return response()->json(['id'=>$req->id]);
   }
}
