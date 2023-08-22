<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function talkRoomIndex()
    {
        $loginUser = auth()->user();

        $rooms = $loginUser->rooms;

        return view('room.index', compact('loginUser', 'rooms'));
    }
}
