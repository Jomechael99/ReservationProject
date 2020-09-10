<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApproverController extends Controller
{
    //
    public function listofApproval(){

        if(Auth::user()->approver == 1){

            $approver_division = Auth::user() -> division;
            $apporver_department = Auth::user() -> department;

            if($approver_division == ""){
                $data_list = db::table('reservation_details as res')
                    ->join('users', 'res.user_id', '=' ,'users.id')
                    ->join('reservation_emo_status as res_status', 'res.reservation_id', '=', 'res_status.reservation_fk_id')
                    ->leftJoin('reservation_details_file as e', 'res.reservation_id', '=', 'e.reservation_fk_id')
                    ->where('users.department', $apporver_department)
                    ->get();
            }else{
                $data_list = db::table('reservation_details as res')
                    ->join('users', 'res.user_id', '=' ,'users.id')
                    ->join('reservation_emo_status as res_status', 'res.reservation_id', '=', 'res_status.reservation_fk_id')
                    ->leftJoin('reservation_details_file as e', 'res.reservation_id', '=', 'e.reservation_fk_id')
                    ->where('users.division', $approver_division)
                    ->get();
            }



            return view('Approval.listofapproval')
                ->with('data', $data_list);

        }else{
            return redirect()->route('StudentLogin');
        }

    }

    function viewofApproval($id){

        $place_libraries = db::table('place_libraries')
            ->get();

        $schedule_data = db::table('reservation_details as a')
            ->leftJoin('reservation_details_others as b', 'a.reservation_id', '=', 'b.reservation_fk_id')
            ->leftJoin('reservation_emo_status as c', 'a.reservation_id', '=', 'c.reservation_fk_id')
            ->leftJoin('reservation_approver_status as d', 'a.reservation_id', '=', 'd.reservation_fk_id')
            ->where('a.reservation_id', $id)
            ->get();



        return view('Approval.viewofapproval')
            ->with('id', $id)
            ->with('place', $place_libraries)
            ->with('schedule', $schedule_data);
    }

    public function getDocument($id){
        return response()->download(storage_path("app/files/{$id}"));
    }


    public function schedule_approving(Request $request){

    }

}
