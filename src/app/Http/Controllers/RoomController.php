<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;

class RoomController extends Controller
{
    public function talkRoomIndex()
    {
        $loginUser = auth()->user();

        $roomId = User::find($loginUser->id)->rooms->map(function ($e) {
            return $e->id;
        });

        $rooms = Room::whereIn('id', $roomId)->where('user_id', '<>', $loginUser->id)->get();

        // dd($rooms[0]->user->nickname);

        return view('room.index', compact('loginUser', 'rooms'));
    }
}