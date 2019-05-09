<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Role;
use App\Department;
use Carbon\Carbon;
use App\RequestDB;
use Illuminate\Support\Facades\Validator;
class Profile extends Controller
{
   public function viewProfile(Request $req){
      $user=User::where('id',Auth::user()->id)->first();
      $roleTitle = Role::pluck('id','roleName');
      $departmentName=Department::pluck('id','departmentName');
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
     return view('editprofile',['profile'=>$user,'role'=>$roleTitle,'department'=>$departmentName,'year'=>$year,'month'=>$month,'yourself'=>$your,"withteam"=>$team,'total'=>$total]);
   }
    public function edit(Request $req){
      $this->validateProfile($req->all())->validate();
      $user=User::where('id',Auth::user()->id)->first();
      $user->firstName=$req->firstName;
      $user->middleName=$req->middleName;
      $user->role=intval($req->role);
      $user->department=intval($req->department);
      //$user->password=bcrypt($req->password);
      $user->save();
      $roleTitle = Role::pluck('id','roleName');
      $departmentName=Department::pluck('id','departmentName');
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
     return view('editprofile',['profile'=>$user,'role'=>$roleTitle,'department'=>$departmentName,'year'=>$year,'month'=>$month,'yourself'=>$your,"withteam"=>$team,'total'=>$total]);
    }
    public function changePassword(){
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
     return view("changePassword",['year'=>$year,'month'=>$month,'yourself'=>$your,"withteam"=>$team,'total'=>$total]);
    }
    public function password(Request $req){
       $this->validatepassword($req->all())->validate();
      $user=User::where('id',Auth::user()->id)->first();
      $user->password=bcrypt($req->password);
      $user->save();
      return 'password is changed';
    }
    protected function validateProfile(array $data){
      return Validator::make($data, [
          'firstName' => 'required|max:15',
          'middleName' => 'max:15',
          'role' => 'required',
          'department' => 'required',

      ]);
    }
    protected function validatepassword(array $data){
      return Validator::make($data, [
             'password' => 'required|min:4',
      ]);
    }
}
