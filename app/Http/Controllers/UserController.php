<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    //

    /*public function postRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {

            return response()->json(['errors'=>$validator->errors()->all()]);

        }

        $data = $request->all();

        $check = $this->create($data);

        return response()->json(array('status' => "success"));

    }*/

    public function postLogin(Request $request){
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('Dashboard');
        }else{
            return redirect()->route('Homepage');
        }
    }
}
