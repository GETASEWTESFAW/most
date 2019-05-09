<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class RegisterController extends Controller
{

      public function register(Request $request)
    {

       //Validates data
        $this->validator($request->all())->validate();

       //Create seller
        $seller = $this->create($request->all());

        //Authenticates seller
        //$this->guard()->login($seller);

       //Redirects sellers
        // return redirect($this->redirectPath);
              return view("auth.login");
    }

    //Validates user's Input
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => 'required|max:15',
            'middleName' => 'max:15',
            'role' => 'required',
            'department' => 'required',
            'email' => 'required|email|max:45|unique:employee',
            'password' => 'required|min:4|confirmed',
        ]);
    }

  protected function create(array $data)
    {
    	// dd($data);
       return User::create([
            'firstName' => $data['firstName'],
            'middleName' => $data['middleName'],
             'role' => intval($data['role']),
             'department' => intval($data['department']),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);  //
}
}
