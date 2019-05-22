<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Controllers\Controller;
use App\Question;
use Symfony\Component\HttpFoundation\Request;

class QuestionController extends Controller
{

    public function getQuestionsByGroup($groupId, Request $request)
    {
        $name = $request->input('name', null);
        $group = $group = Group::findOrFail($groupId);
        $questions = Question::where('group_id', '=', $group->id);
        if ($name) {
            $questions = $questions->where('question', 'LIKE', '%' . $name . '%');
        }
        $questions = $questions->paginate(10);
        return response()->json($questions, 200);
    }
}