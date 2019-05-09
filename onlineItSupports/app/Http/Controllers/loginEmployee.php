<?php

namespace App\Http\Controllers;
use Auth;
use App\RequestDB;
use App\Category;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class loginEmployee extends Controller
{
  public function login(Request $req){
  	$sender=Auth::user()->id;
  	     $category=Category::pluck('id','title');
          $request=RequestDB::where("sender",$sender)
                               ->where("status",'!=',2)->get();
          foreach ($request as $value) {
             $title=$value->title;
             $value->title=Category::where("id",$title)->value('title');
             $status=$value->status;
             $value->status=Status::where('id',$status)->value('status');
          }
        return view('Ehome',['category'=>$category,'request'=>$request]);
  }
}
