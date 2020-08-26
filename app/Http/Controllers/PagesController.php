<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

            $office = db::table('office_libraries')
                ->get();

            $department = db::table('department_libraries')
                ->get();

            $division = db::table('division_libraries')
                ->get();

            return view('Reservation.Loginpage')
                ->with(['office' => $office , 'division' => $division , 'department' => $department]);
        }
    }

    public function viewDashboard(){
        return view('dashboard');
    }

    public function accountLogout(){
        Auth::logout();
        return redirect()->route('StudentLogin');
    }


}
