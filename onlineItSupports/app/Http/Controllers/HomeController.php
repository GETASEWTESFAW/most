<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $require)
    {
      if(Auth::user()->activation==1 && Auth::user()->isApproved=='1'){
           $rol=Auth::user()->role;
             if ($rol==1) {
              return redirect()->action("loginDirector@login");
             }
             if($rol==2){
              return redirect()->action("loginAdministrator@login");
             }
             if ($rol==3) {
              return redirect()->action("loginEmployee@login");
             }
       }
        return view('auth.login');
    }
}
