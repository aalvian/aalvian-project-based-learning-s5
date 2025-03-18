<?php

namespace App\Http\Controllers;

use App\Models\TimeLine;
use Illuminate\Http\Request;

class TimeLineController extends Controller
{
    // function untuk admin melihat data timeline
    public function index(){
        return TimeLine::timeline_index();
    }

    // function untuk admin mengupdate data timeline
    public function update(Request $request, $id){
        return TimeLine::timeline_update($request, $id);
    }

    // function untuk user melihat data timeline
    public function timeline(){
        return TimeLine::timeline_user();
    }
}


