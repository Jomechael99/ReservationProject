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

}
