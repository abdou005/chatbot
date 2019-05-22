<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function registerUser(UserRequest $request)
    {
        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $password = $request->get('password');
        $email = $request->get('email');
        $image = $request->file('image');
        $path = null;
        if ($image) {
            $path = uploadFile($image, 'user_profile', time());
        }
        if (!$path) {
            $path = generateAvatarByName($firstName, $lastName);
        }
        $user = UserRepository::createUser($firstName, $lastName, $email, $password, $path);
        return response()->json(['status' => 'success', 'data' => $user], 200);
    }

    public function loginUser(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::findByEmail($email);
        if ($user) {
            if ($user->status === 0){
                return response()->json(['status' => 'error', 'message' => 'User disabled'], 406);
            }
            if (Hash::check($password, $user->password)) {
                $token = JWTAuth::fromUser($user);
                $user->token = $token;
                $user->save();
                return response()->json(['status' => 'success', 'data' => $user], 200);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'invalid_credentials'], 404);
    }

    public function logoutUser()
    {
        $user = auth()->user();
        $user->token = null;
        $user->save();
        return response()->json(['status' => 'success'], 200);
    }
}