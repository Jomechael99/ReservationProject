<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EMOController extends Controller
{
    //
    public function viewSchedule(){
        if(Auth::user()->approver == 2){


                $data_list = db::table('reservation_details as res')
                    ->join('users', 'res.user_id', '=' ,'users.id')
                    ->leftjoin('reservation_approver_status as res_status', 'res.reservation_id', '=', 'res_status.reservation_fk_id')
                    ->leftJoin('reservation_details_file as e', 'res.reservation_id', '=', 'e.reservation_fk_id')
                    ->leftjoin('reservation_emo_status as emo', 'res.reservation_id', '=', 'emo.reservation_fk_id')
                    ->where('res_status.reservation_status', 1)
                    ->get();


            return view('EMO.listofschedule')
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
            ->leftJoin('facilities_libraries as e', 'b.reservation_others_details', '=', 'e.id')
            ->join('users as f', 'a.user_id', '=', 'f.id')
            ->leftJoin('division_libraries as g', 'g.id' ,'=', 'a.reservation_division')
            ->leftJoin('department_libraries as h', 'h.id' ,'=', 'a.reservation_department')
            ->where('a.reservation_id', $id)
            ->get();

        return view('Approval.viewofapproval')
            ->with('id', $id)
            ->with('place', $place_libraries)
            ->with('schedule', $schedule_data);
    }

    public function schedule_approving(Request $request){

        if($request->approve_status == 1){
            $schedule_approved_data = [
                'reservation_emo_status' => 1,
                'reservation_received_by' => $request->receivedby,
                'reservation_approved_time' => date("Y-m-d H:i:s")
            ];
        }else{
            $schedule_approved_data = [
                'reservation_emo_status' => 0,
                'reservation_received_by' => $request->receivedby,
                'reservation_approved_time' => date("Y-m-d H:i:s")
            ];
        }


        $approved = db::table('reservation_emo_status')
            ->where('reservation_fk_id', $request->id)
            ->update($schedule_approved_data);

        if($approved == true){
            return response()->json(array('status' => "success"));
        }else{
            return response()->json(array('status' => "failed"));
        }

    }
}
