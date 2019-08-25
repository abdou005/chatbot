<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Group;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class QuestionController extends Controller
{

    public function getQuestions(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->input('start');
            $length = $request->input('length');
            $draw = $request->input('draw');
            $name = $request->input('name_search');
            $questions = QuestionRepository::searchQuestionsByFilter($name, true, $start, $length);
            $response = [
                'draw' => $draw,
                "recordsTotal" => $questions->total(),
                "recordsFiltered" => $questions->total(),
                "data" => $questions->items()
            ];
            return response()->json($response, 200);
        }
        return view('dashboard.questions.questions-layout-list');
    }

    public function findQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        return response()->json($question, 200);
    }

    public function removeQuestion($questionId)
    {
        $question = Question::findOrFail($questionId);
        $question->delete();
        return response()->json(['status' => 'success', 'message' => 'Question supprimée avec succes'], 200);
    }

    public function createQuestion(QuestionRequest $request)
    {
        $question = $request->get('question');
        $response = $request->get('response');
        $groupId = $request->get('group');
        $group = Group::findOrFail($groupId);
        QuestionRepository::createQuestion($question, $response, $group);
        return response()->json(['status' => 'success', 'message' => 'Question ajoutée avec succes'], 200);
    }

    public function updateQuestion($questionId, QuestionRequest $request)
    {
        $question = Question::findOrFail($questionId);
        $questionTxt = $request->get('question');
        $response = $request->get('response');
        $questionRepository = new QuestionRepository($question);
        $groupId = $request->get('group');
        $group = null;
        if ($groupId) {
            $group = Group::findOrFail($groupId);
        }
        $questionRepository->updateQuestion($questionTxt, $response, $group);
        return response()->json(['status' => 'success', 'message' => 'Question modifiée avec succes'], 200);
    }

    public function getQuestionsByGroup($groupId, Request $request){
        $user = auth()->user();
        $name = $request->input('name', null);
        if ($name){
//            $histories = $user->histories()
//                ->join('questions', 'questions.id', '=', 'histories.question_id')
//                ->where('questions.group_id', '=', $groupId)->select('histories.question_id')->get();
            $questions = Question::where('question', 'LIKE', '%' . $name . '%')
                ->where('type', '=', Question::USED)
                //->whereNotIn('id', $histories)
                ->where('group_id', '=', $groupId)
                ->paginate(10);
            return response()->json($questions, 200);
        }
        return response()->json([], 200);

    }
}