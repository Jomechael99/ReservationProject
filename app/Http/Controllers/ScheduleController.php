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
            ->join('reservation_approver_status as c', 'a.reservation_id', '=', 'c.reservation_fk_id')
            ->leftjoin('reservation_ticket_status as d', 'd.res_fk_id', '=' , 'a.reservation_id')
            ->where('a.user_id', Auth::user()->id)
            ->orderBy('reservation_id', 'desc')
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

        $reservation_count = db::table('reservation_details')
            ->get();

        $additional_facilities = db::table('facilities_libraries')
            ->get();

        $cnt = 0;

        if(count($reservation_count) == 0){
            $cnt = 1;
        }else{
            $cnt =  count($reservation_count);
        }

        $division = db::table('division_libraries')
            ->OrderBy('division_type')
            ->OrderBy('division_name')
            ->get();

        return view('StudentPortal.Schedule.addschedule')
            ->with(['place' => $place_libraries, 'cnt' => $cnt , 'division' => $division , 'facilities' => $additional_facilities]);
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

        if ($request->scheduledPlace == "7") {
            $others = $request->other_place;
        } else {
            $others = "";
        }

        $start_date = date('Y-m-d H:i:s', strtotime("$request->useDate $request->timeStart"));
        $end_date = date('Y-m-d H:i:s', strtotime("$request->useDate $request->timeEnd"));

        // $existing_data = db::table('reservation_details')
        //     ->where('facility_id', '=', $request->scheduledPlace)
        //     ->where(DB::raw('( reservation_start between cast($start_date as DATETIME ) and cast( $end_date as DATETIME ) OR reservation_end between cast( $start_date as DATETIME ) and cast( $end_date as DATETIME ) )' ))
        //     ->get();

        $existing_data = db::table('reservation_details')
            ->where('facility_id', $request->scheduledPlace)
            ->where(function ($query) use ($start_date,$end_date) {
                $query
                ->whereBetween('reservation_start', [$start_date , $end_date])
                ->orwhereBetween('reservation_end', [$start_date , $end_date]);
            })->get();

        if (count($existing_data) >= 1) {
            return response()->json(['status' => "existing"]);
        } else {

                $reservation_details_data = [
                    'user_id' => $request->ApplicantsId,
                    'facility_id' =>$request->scheduledPlace,
                    'reservation_date' => $request->useDate,
                    'reservation_start'=> $start_date,
                    'reservation_end'=> $end_date,
                    'facility_others'=>$others,
                    'reservation_purpose'=>$request->Purpose,
                    'reservation_date_applied'=> $request->dateApplied,
                    'reservation_division' => $request->Division,
                    'reservation_department' => $request->Department
                ];

                $id = db::table('reservation_details')
                    ->insertGetId($reservation_details_data);


                if($request->hasFile('fileDocument')) {

                    $allowedfileExtension=['pdf','jpg','png','docx'];

                    $files = $request->file('fileDocument');



                    $filename =  'file-'.time().'.'.$files->getClientOriginalExtension();;
                    $extension = $files->getClientOriginalExtension();

                    $check=in_array($extension,$allowedfileExtension);

                    $path = $files->storeAs('files', $filename);

                    $file_data = [
                        'name' => $filename,
                        'reservation_fk_id' => $id
                    ];

                    $file_insert = db::table('reservation_details_file')
                        ->insert($file_data);
                }

                if( $request -> additional == ""){

                    $res_details_others = true;

                }else{
                    for($i = 0 ; $i < count($request->additional); $i++){
                        $res_details_others = db::table('reservation_details_others')
                            ->insert([
                               'reservation_others_details' => $request->additional[$i],
                                'facilities_qty' => $request->qty[$i],
                                'reservation_fk_id' => $id
                            ]);
                    }
                }


                $res_emo_status = db::table('reservation_emo_status')
                    ->insert([
                        'reservation_fk_id' => $id,
                        'reservation_received_by' => "",
                        'reservation_emo_status' => 0,
                    ]);

                $res_approver = db::table('reservation_approver_status')
                    ->insert([
                        'reservation_fk_id' => $id,
                        'reservation_status' => 2
                    ]);


        if ($res_details_others == true && $res_emo_status == true && $res_approver == true) {
            return response()->json(['status' => "success"]);
        } else {
            return response()->json(['status' => "error"]);
        }

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

        $schedule_data = \Illuminate\Support\Facades\DB::table('reservation_details as a')
            ->leftJoin('reservation_details_others as b', 'a.reservation_id', '=', 'b.reservation_fk_id')
            ->leftJoin('reservation_emo_status as c', 'a.reservation_id', '=', 'c.reservation_fk_id')
            ->leftJoin('reservation_approver_status as d', 'a.reservation_id', '=', 'd.reservation_fk_id')
            ->leftJoin('facilities_libraries as e', 'b.reservation_others_details', '=', 'e.id')
            ->join('users as f', 'a.user_id', '=', 'f.id')
            ->leftJoin('division_libraries as g', 'g.id' ,'=', 'a.reservation_division')
            ->leftJoin('department_libraries as h', 'h.id' ,'=', 'a.reservation_department')
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
