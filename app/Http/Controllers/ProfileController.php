<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class ProfileController extends Controller
{
    public function updateUser($userId, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required', 'email', 'max:255',
                Rule::unique('users')->where(function ($query) use ($userId) {
                    $query->where('id', '!=', $userId);
                }),
            ],
            'image' => 'image|mimes:jpeg,jpg,png|dimensions:max_width=600,max_height=600',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $user = User::findOrFail($userId);
        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $email = $request->get('email');
        $image = $request->file('image');
        $avatar = $user->image;
        if ($image) {
            $avatar = uploadFile($image, 'user_profile', generateNewRandomString());
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
        }
        $userRepository = new UserRepository($user);
        $userRepository->updateUser($firstName, $lastName, $email, $avatar);
        return redirect('/profile');
    }

}