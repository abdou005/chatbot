<?php

namespace App\Http\Controllers\Api;

use App\History;
use App\Http\Controllers\Controller;
use App\Question;
use Illuminate\Http\Request;

class HistoryController extends Controller
{

    public function responseToQuestion(Request $request)
    {
        $questionId = $request->get('question_id');
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
        return response()->json(['status' => 'success', 'data' => $history], 200);
    }
}