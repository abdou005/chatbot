<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\UserRequest;
use App\History;
use App\Question;
use App\Repositories\QuestionRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function histories(){
        return view('dashboard.histories.histories-layout-list');
    }

    public function getHistoriesByGroup($groupId, Request $request)
    {
        $user = auth()->user();
        $group = Group::findOrFail($groupId);
        $histories = $user->histories()
            ->join('questions', 'questions.id', '=', 'histories.question_id')
            ->where('questions.group_id', '=', $groupId)
            ->with(['question' => function ($question) {
            $question->with('group');
        }])->orderBy('histories.created_at', 'desc')->get();
        return response()->json(['histories' => $histories, 'group' => $group], 200);
    }

    public function responseToQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        $user = auth()->user();
//        $history = $user->histories()->where('question_id', '=', $question->id)->first();
//        if ($history){
//            return response()->json(['message' => 'history already exist'], 406);
//        }
        $history = new History();
        $history->user_id = $user->id;
        $history->question_id = $question->id;
        $history->save();
        $history->question = $question;
        $history->user = $user;
        return response()->json($history, 200);
    }

    public function addQuestionAndHistory($groupId, Request $request)
    {
        $question = $request->get('question');
        $user = auth()->user();
        if (!$question){
            return response()->json(['message' => 'question required'], 406);
        }
        $group = Group::findOrFail($groupId);
        $response = 'Aucune reponse pour cette question';
        $questionCreated = QuestionRepository::createQuestion($question, $response, $group, Question::NOT_USED);
        $history = new History();
        $history->user_id = $user->id;
        $history->question_id = $questionCreated->id;
        $history->save();
        $history->question = $questionCreated;
        $history->user = $user;
        return response()->json($history, 200);
    }

    public function getProfile()
    {
        return view('dashboard.profile.profile-layout-list');
    }

    public function addUser(UserRequest $request){

        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $email = $request->get('email');
        $password = $request->get('password');
        $image = $request->file('image');
        $path = null;
        if ($image) {
            $path = uploadFile($image, 'user_profile', time());
        }
        if (!$path) {
            $path = generateAvatarByName($firstName, $lastName);
        }
        UserRepository::createUser($firstName, $lastName, $email, $password, $path);
        return response()->json(['status' => 'success', 'message' => 'Utilisateur ajouté avec succes'], 200);
    }

    public function findUser($userId){
        $user = User::findOrFail($userId);
        return response()->json($user, 200);
    }

    public function updateUser($userId, UserRequest $request)
    {

        $user = User::findOrFail($userId);
        $firstName = $request->get('first_name');
        $lastName = $request->get('last_name');
        $email = $request->get('email');
        $image = $request->file('image');
        $password = $request->get('password');
        $avatar = $user->image;
        if ($image) {
            $avatar = uploadFile($image, 'user_profile', generateNewRandomString());
            if ($user->image && file_exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
        }
        $userRepository = new UserRepository($user);
        $userRepository->updateUser($firstName, $lastName, $email, $avatar, $password);
        return response()->json(['status' => 'success', 'message' => 'Utilisateur modifié avec succes'], 200);
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
        if($user->status === 1){
            $user->status = 0;
        }else{
            $user->status = 1;
        }
        $user->save();
        return response()->json(['status' => 'success', 'message' => 'Utilisateur modifié avec succes'], 200);

    }
}