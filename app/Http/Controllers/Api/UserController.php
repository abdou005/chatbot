<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

    public function getProfile()
    {
        $user = auth()->user();
        $histories = $user->histories()->with(['question' => function ($question) {
            $question->with('group');
        }])->get();
        $user->histories = $histories;
        $user->makeHidden(['token', 'email_verified_at']);
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }

}