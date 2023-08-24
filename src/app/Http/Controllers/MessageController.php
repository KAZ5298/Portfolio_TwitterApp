<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Room;

class MessageController extends Controller
{
    public function messagePost(Request $request, Room $room)
    {
        $message = new Message();

        $message->room_id = $room->id;
        $message->user_id = auth()->user()->id;
        $message->message = $request->message;

        $message->save();

        return back();
    }
}
