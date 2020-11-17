<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TicketingController extends Controller
{
    //
    function viewListItems($id){

        $items = db::table('reservation_details_others as a')
            ->select('a.id', 'facilities_name' , 'reservation_fk_id', 'facilities_qty', 'reservation_status', 'reservation_others_before', 'reservation_other_after')
            ->join('facilities_libraries as b', 'a.reservation_others_details' , '=', 'b.id')
            ->leftjoin('reservation_others_status as c', 'a.reservation_fk_id', '=' , 'c.id_fk')
            ->where('reservation_fk_id', $id)
            ->get();

        return view('Ticketing.viewitems')
            ->with('items' , $items);

    }

    function addListItemsStatus(Request $request){


        if($request->status == "3"){
            for($i = 0 ; $i < count($request->id) ; $i++){
                db::table('reservation_details_others')
                    ->where('id', $request->id[$i])
                    ->update(['reservation_others_before' => $request->before[$i]]);
            }

            db::table('reservation_others_status')
                ->insert([
                    'id_fk' => $request->fk_id,
                    'reservation_status' => "1"
                ]);


        }elseif($request->status == "2"){

            db::table('reservation_others_status')
                ->where('id_fk', $request->fk_id)
                ->update([
                    'reservation_status' => "3"
                ]);

        }elseif($request->status == "1"){
            for($i = 0 ; $i < count($request->id) ; $i++){
                db::table('reservation_details_others')
                    ->where('id', $request->id[$i])
                    ->update(['reservation_other_after' => $request->after[$i]]);
            }
            db::table('reservation_others_status')
                ->where('id_fk', $request->fk_id)
                ->update([
                    'reservation_status' => "2"
                ]);
        }

        return response()->json(array('status' => "success"));

    }
}
