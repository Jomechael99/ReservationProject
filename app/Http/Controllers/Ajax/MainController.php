<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    //

    public function calendar_place($id){

        $start = "";
        $end = "";
        $place = "";
        $name = "";
        $purpose = "";

        if($id == "7"){

            $data_list = db::table('reservation_details as res')
                ->join('users', 'res.user_id', '=', 'users.id')
                ->leftjoin('reservation_approver_status as res_status', 'res.reservation_id', '=', 'res_status.reservation_fk_id')
                ->leftJoin('reservation_details_file as e', 'res.reservation_id', '=', 'e.reservation_fk_id')
                ->leftjoin('reservation_emo_status as emo', 'res.reservation_id', '=', 'emo.reservation_fk_id')
                ->join('place_libraries as place', 'place.id', '=', 'res.facility_id')
                ->where('emo.reservation_emo_status', 1)
                ->get()
                ->toArray();

        }else {


            $data_list = db::table('reservation_details as res')
                ->join('users', 'res.user_id', '=', 'users.id')
                ->leftjoin('reservation_approver_status as res_status', 'res.reservation_id', '=', 'res_status.reservation_fk_id')
                ->leftJoin('reservation_details_file as e', 'res.reservation_id', '=', 'e.reservation_fk_id')
                ->leftjoin('reservation_emo_status as emo', 'res.reservation_id', '=', 'emo.reservation_fk_id')
                ->join('place_libraries as place', 'place.id', '=', 'res.facility_id')
                ->where('emo.reservation_emo_status', 1)
                ->where('facility_id', $id)
                ->get()
                ->toArray();

        }


        /*foreach($data_list as $data){

            $start = $data -> reservation_start;
            $end = $data -> reservation_end;
            $name = $data -> lastname .",". $data -> firstname;
            $purpose = $data -> reservation_purpose;
            $place = $data -> place_name;



        }

        $array = [
            'start' => $start,
            'end'=> $end,
            'name' => $name ,
            'purpose' => $purpose,
            'place' => $place
        ];*/

        return response() -> json($data_list);


    }
}
