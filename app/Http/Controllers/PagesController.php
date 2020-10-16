<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

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

        $data_list = db::table('reservation_details as res')
            ->join('users', 'res.user_id', '=' ,'users.id')
            ->leftjoin('reservation_approver_status as res_status', 'res.reservation_id', '=', 'res_status.reservation_fk_id')
            ->leftJoin('reservation_details_file as e', 'res.reservation_id', '=', 'e.reservation_fk_id')
            ->leftjoin('reservation_emo_status as emo', 'res.reservation_id', '=', 'emo.reservation_fk_id')
            ->where('emo.reservation_emo_status', 1)
            ->get();


        if(Auth::user() -> approver == 1 || Auth::user() -> approver == 2){
            return view('approver_dashboard')
                ->with(['place' => $place_libraries, 'data' => $data_list]);
        }else{
            return view('dashboard')
                ->with(['place' => $place_libraries, 'data' => $data_list]);
        }

    }

    public function accountLogout(){
        Auth::logout();
        return redirect()->route('StudentLogin');
    }


}
