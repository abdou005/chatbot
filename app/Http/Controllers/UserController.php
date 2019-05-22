<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends Controller
{

    public function getProfile()
    {
        return view('dashboard.profile.profile-layout-list');
    }

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

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->input('start');
            $length = $request->input('length');
            $draw = $request->input('draw');
            $name = $request->input('name_search');
            $users = UserRepository::searchUsersByFilter($name, true, $start, $length);
            $response = [
                'draw' => $draw,
                "recordsTotal" => $users->total(),
                "recordsFiltered" => $users->total(),
                "data" => $users->items()
            ];
            return response()->json($response, 200);
        }
        return view('dashboard.users.users-layout-list');
    }


    public function removeUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();
        if($user->image && file_exists(public_path($user->image))) {
            unlink(public_path($user->image));
        }
        return response()->json(['status' => 'success', 'message' => 'Utilisateur supprimé avec succes'], 200);
    }

    public function updateStatus($userId){
        $user = User::findOrFail($userId);
        $status = $user->status;
        if($user->status === 1){
            $user->status = 0;
        }else{
            $user->status = 1;
        }
        $user->save();
        return response()->json(['status' => 'success', 'message' => 'Utilisateur modifié avec succes'], 200);

    }
}