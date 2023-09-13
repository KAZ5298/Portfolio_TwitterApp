<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Room;
use App\Http\Requests\MessageRequest;

class MessageController extends Controller
{
    public function messagePost(MessageRequest $request, Room $room)
    {

        $message = new Message();

        $message->room_id = $room->id;
        $message->user_id = auth()->user()->id;
        $message->message = $request->message;

        $message->save();

        return back()->with('message', 'メッセージを投稿しました。');
    }
}
