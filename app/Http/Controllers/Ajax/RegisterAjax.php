<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterAjax extends Controller
{
    //

    public function viewOrganization($id){

        $option = "";
        $organization = db::table('organization_libraries')
            ->where('deparment_fk_id', $id)
            ->get();

        foreach($organization as $data){
            $option .= '<option value="'.$data -> id.'"> '.$data -> organization_name .' </option>';
        }

        return response()->json( array('option' => $option));

    }

}

