<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Role;
use App\Department;
use App\RequestDB;
use App\Category;
use App\User;
use App\Ictteam;
class loginDirector extends Controller
{
   public function login(Request $req){
   	     $newEmployee=User::where('isApproved','0')->where('activation',1)->get();
          foreach ($newEmployee as $key) {
            $dp=$key->department;
            $r=$key->role;
            $key->roleId=$r;
            $key->department=Department::where('id',$dp)->value('departmentName');
            $key->role=Role::where('id',$r)->value('roleName');

          }
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
          }
          $admin=User::where('role',2)->Where('isApproved','1')->get();
          $team=Ictteam::all();
       return view('Dhome',['employee'=>$newEmployee,'request'=>$request,'admins'=>$admin,'teams'=>$team]);
   }
}
