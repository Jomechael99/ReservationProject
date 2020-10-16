<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    //

    public function viewDepartment($id){

        $department = db::table('department_libraries')
            ->where('department_type', $id)
            ->get();

        $option = "";

        foreach($department as $data){
            $option .= '<option value="'.$data -> id.'"> '.$data -> department_name .' </option>';
        }

        return response()->json( array('option' => $option));

    }

    public function schedule_approving(Request $request){

        if($request->approve_status == 1){
            $schedule_approved_data = [
                'reservation_status' => 1,
            ];
        }else{
            $schedule_approved_data = [
                'reservation_status' => 0,
                'reservation_reason' => $request->reason
            ];
        }

        $approved = db::table('reservation_approver_status')
            ->where('reservation_fk_id', $request->id)
            ->update($schedule_approved_data);

        if($approved == true){
            return response()->json(array('status' => "success"));
        }else{
            return response()->json(array('status' => "failed"));
        }

    }

}
