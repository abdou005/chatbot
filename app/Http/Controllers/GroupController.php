<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Question;
use App\Repositories\GroupRepository;
use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function getGroups(Request $request)
    {
        if ($request->ajax()) {
            $start = $request->input('start');
            $length = $request->input('length');
            $draw = $request->input('draw');
            $name = $request->input('name_search');
            $groups = GroupRepository::searchGroupsByFilter($name, true, $start, $length);
            $response = [
                'draw' => $draw,
                "recordsTotal" => $groups->total(),
                "recordsFiltered" => $groups->total(),
                "data" => $groups->items()
            ];
            return response()->json($response, 200);
        }
        return view('dashboard.groups.groups-layout-list');
    }

    public function findGroup($groupId)
    {
        $group = Group::findOrFail($groupId);
        return response()->json($group, 200);
    }

    public function removeGroup($groupId)
    {
        $group = Group::findOrFail($groupId);
        $group->delete();
        return response()->json(['status' => 'success', 'message' => 'Groupe supprimé avec succes'], 200);
    }

    public function createGroup(GroupRequest $request)
    {
        $title = $request->get('title');
        $desc = $request->get('desc');
        GroupRepository::createGroup($title, $desc);
        return response()->json(['status' => 'success', 'message' => 'Groupe ajouté avec succes'], 200);
    }

    public function updateGroup($groupId, GroupRequest $request)
    {
        $group = Group::findOrFail($groupId);
        $title = $request->get('title');
        $desc = $request->get('desc');
        $groupRepository = new GroupRepository($group);
        $groupRepository->updateGroup($title, $desc);
        return response()->json(['status' => 'success', 'message' => 'Groupe modifié avec succes'], 200);
    }

    public function getGroupsSelect(Request $request)
    {
        $name = $request->get('q');
        $incompleteResults = true;
        $groups = Group::where('title', 'LIKE', '%' . $name . '%')->paginate(10);
        $groupsAr = $groups->toArray();
        if ($groupsAr['next_page_url'] == null) {
            $incompleteResults = false;
        }
        $results = [
            "total_count" => $groupsAr['total'],
            "incomplete_results" => $incompleteResults,
            'items' => $this->transformData($groups)
        ];
        return response()->json($results, 200);
    }

    public function getQuestionsSelect(Request $request)
    {
        $name = $request->get('q');
        $groupId = $request->get('group_id');
        if (!$groupId){
            return response()->json(['message' => 'group required'], 406);
        }
        $user = auth()->user();
//        $histories = $user->histories()
//            ->join('questions', 'questions.id', '=', 'histories.question_id')
//            ->where('questions.group_id', '=', $groupId)->select('histories.question_id')->get();
        $incompleteResults = true;
        $questions = Question::where('question', 'LIKE', '%' . $name . '%')
            //->whereNotIn('id', $histories)
            ->where('group_id', '=', $groupId)
            ->where('type', '=', Question::USED)
            ->paginate(10);
        $questionsAr = $questions->toArray();
        if ($questionsAr['next_page_url'] == null) {
            $incompleteResults = false;
        }
        $results = [
            "total_count" => $questionsAr['total'],
            "incomplete_results" => $incompleteResults,
            'items' => $this->transformDataQuestion($questions)
        ];
        return response()->json($results, 200);
    }
    private function transformDataQuestion($questions)
    {
        $data = [];
        foreach ($questions as $question) {
            array_push($data, ['id' => $question->id, 'text' => $question->question]);
        }
        return ($data);
    }
    private function transformData($groups)
    {
        $data = [];
        foreach ($groups as $group) {
            array_push($data, ['id' => $group->id, 'text' => $group->title]);
        }
        return ($data);
    }
}