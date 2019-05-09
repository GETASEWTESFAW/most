<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use App\Category;
use App\RequestDB;
use Illuminate\Http\Request;
use Carbon\Carbon;
class loginAdministrator extends Controller
{
    public function login(Request $req){

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


    	return view('home',['request'=>$request,'year'=>$year,'month'=>$month,'yourself'=>$your,"withteam"=>$team,'total'=>$total]);
    }
}
