<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function select_meeting()
    {
        // 
    }

    public function index($meeting_id)
    {
        // 参加者をミーティングで絞込み
        $meetings = Meeting::orderBy('created_at', 'desc')->get();
        return view('meeting/index', compact('meetings'));
    }

    public function show($id)
    {

    }

    public function meeting1_select($answer)
    {

    }

    public function meeting2_select($ansewr)
    {

    }

    public function meeting1_finish()
    {

    }

    public function meeting2_finish()
    {
        
    }
}
