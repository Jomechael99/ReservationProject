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
            return redirect()->route('Dashboard');
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

        $place_libraries = db::table('place_libraries')
            ->get();

        if(Auth::user() -> approver == 1){
            return view('approver_dashboard')
                ->with('place', $place_libraries);
        }else{
            return view('dashboard')
                ->with('place', $place_libraries);
        }

    }

    public function accountLogout(){
        Auth::logout();
        return redirect()->route('StudentLogin');
    }


}
