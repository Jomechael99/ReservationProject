<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $schedule_data = db::table('reservation_details as a')
            ->join('reservation_emo_status as b', 'a.reservation_id', '=', 'b.reservation_fk_id')
            ->get();

        return view('StudentPortal.Schedule.viewschedule')
            ->with('data', $schedule_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        $place_libraries = db::table('place_libraries')
            ->get();

        return view('StudentPortal.Schedule.addschedule')
            ->with('place', $place_libraries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Reservation Details

        if($request->scheduledPlace == "7"){
            $others = $request->other_place;
        }else{
            $others = "";
        }

        $reservation_details_data = [
            'user_id' => $request->ApplicantsId,
            'facility_id' =>$request->scheduledPlace,
            'reservation_date' => $request->useDate,
            'reservation_start'=> date('Y-m-d H:i:s', strtotime("$request->useDate $request->timeStart")),
            'reservation_end'=>date('Y-m-d H:i:s', strtotime("$request->useDate $request->timeEnd")),
            'facility_others'=>$others,
            'reservation_date_applied'=> $request->dateApplied
        ];

        $id = db::table('reservation_details')
            ->insertGetId($reservation_details_data);

        if( $request -> additional == ""){

            $res_details_others = true;

        }else{
            for($i = 0 ; $i < count($request->additional); $i++){
                $res_details_others = db::table('reservation_details_others')
                    ->insert([
                       'reservation_others_details' => $request->additional[$i],
                        'reservation_fk_id' => $id
                    ]);
            }
        }


        $res_emo_status = db::table('reservation_emo_status')
            ->insert([
                'reservation_fk_id' => $id,
                'reservation_received_by' => "",
                'reservation_status' => 0,
            ]);

        $res_approver = db::table('reservation_approver_status')
            ->insert([
                'reservation_fk_id' => $id
            ]);

        if($res_details_others == true && $res_emo_status == true && $res_approver == true){
            return response()->json(['status' => "success"]);
        }else{
            return response()->json(['status' => "error"]);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $place_libraries = db::table('place_libraries')
            ->get();

        $schedule_data = db::table('reservation_details as a')
            ->leftJoin('reservation_details_others as b', 'a.reservation_id', '=', 'b.reservation_fk_id')
            ->leftJoin('reservation_emo_status as c', 'a.reservation_id', '=', 'c.reservation_fk_id')
            ->leftJoin('reservation_approver_status as d', 'a.reservation_id', '=', 'd.reservation_fk_id')
            ->where('a.reservation_id', $id)
            ->get();


        return view('StudentPortal.Schedule.viewaddedschedule')
            ->with('place', $place_libraries)
            ->with('schedule', $schedule_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
