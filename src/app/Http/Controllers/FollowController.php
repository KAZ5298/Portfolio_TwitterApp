<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;

class FollowController extends Controller
{
    // フォロー一覧表示
    public function allFollowGet()
    {
        $loginUser = auth()->user();

        $followId = User::find($loginUser->id)->follows->map(function ($id) {
            return $id->id;
        });

        $follows = User::whereIn('id', $followId)->get();

        return view('follow.index', compact('loginUser', 'follows'));
    }
}
