<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sinup;

class CrudsController extends Controller
{
    function fetched(){
        $sql = sinup::all();

        if($sql->isEmpty()){
            return response()->json([
                'status' => false,
                'message' => 'no data yet'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'your data has been fetched',
            'data' => $sql
        ]);
    }
}
