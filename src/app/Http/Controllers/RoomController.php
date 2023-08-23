<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\User;
use App\Models\Message;

class RoomController extends Controller
{
    public function talkRoomIndex()
    {
        $loginUser = auth()->user();

        $roomId = User::find($loginUser->id)->rooms->map(function ($e) {
            return $e->id;
        });

        $rooms = Room::whereIn('id', $roomId)->where('user_id', '<>', $loginUser->id)->get();

        return view('room.index', compact('loginUser', 'rooms'));
    }

    public function talkRoomShow(Room $room)
    {
        $loginUser = auth()->user();

        $rooms = Room::where('id', $room->id)->where('user_id', '<>', $loginUser->id)->first();

        $messages = Message::where('room_id', $room->id)->get();

        // dd($messages);

        return view('room.show', compact('loginUser', 'rooms', 'messages'));
    }
}