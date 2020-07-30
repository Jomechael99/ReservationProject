<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    //

    public function viewHomepage(){
        return view('homepage');
    }

    public function viewStudentLogin(){
        if(Auth::check()){
            return view('dashboard');
        }else{
            return view('Reservation.Loginpage');
        }
    }

    public function viewDashboard(){
        return view('dashboard');
    }

    public function accountLogout(){
        Auth::logout();
        return view('Reservation.Loginpage');
    }


}
