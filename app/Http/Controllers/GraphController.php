<?php

namespace App\Http\Controllers;

use App\Group;
use App\Question;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{


    public function getGraphs()
    {
        return view('dashboard.graph.graphs-layout-list');
    }

    public function getGraphUser(Request $request){
        if ($request->ajax()){
            $startAt = $request->input('start_at', 0);
            $endAt = $request->input('end_at', 9999999999);
            $users = User::select('created_at', DB::raw('COUNT(*) as count_user'), DB::raw('DAY(created_at) as day'));
            if ($startAt){
                $users = $users->where('created_at', '>=', $startAt);
            }
            if ($startAt){
                $users = $users->where('created_at', '<=', $endAt);
            }
            $users = $users->groupBy('day')->orderBy('created_at', 'asc')->get();
            $users->each(function(User $user){
                $user->created_date = date("d-m-Y", strtotime($user->created_at));
            });
            return response()->json($users, 200);
        }
        return view('dashboard.users.users-layout-list-graph');
    }
    public function getGraphGroup(Request $request){
        if ($request->ajax()){
            $startAt = $request->input('start_at', 0);
            $endAt = $request->input('end_at', 9999999999);
            $groups = Group::select('created_at', DB::raw('COUNT(*) as count_group'), DB::raw('DAY(created_at) as day'));
            if ($startAt){
                $groups = $groups->where('created_at', '>=', $startAt);
            }
            if ($startAt){
                $groups = $groups->where('created_at', '<=', $endAt);
            }
            $groups = $groups->groupBy('day')->orderBy('created_at', 'asc')->get();
            $groups->each(function(Group $group){
                $group->created_date = date("d-m-Y", strtotime($group->created_at));
            });
            return response()->json($groups, 200);
        }
        return view('dashboard.groups.groups-layout-list-graph');
    }
    public function getGraphQuestion(Request $request){
        if ($request->ajax()){
            $startAt = $request->input('start_at', 0);
            $endAt = $request->input('end_at', 9999999999);
            $questions = Question::select('created_at', DB::raw('COUNT(*) as count_question'), DB::raw('DAY(created_at) as day'));
            if ($startAt){
                $questions = $questions->where('created_at', '>=', $startAt);
            }
            if ($startAt){
                $questions = $questions->where('created_at', '<=', $endAt);
            }
            $questions = $questions->groupBy('day')->orderBy('created_at', 'asc')->get();
            $questions->each(function(Question $question){
                $question->created_date = date("d-m-Y", strtotime($question->created_at));
            });
            return response()->json($questions, 200);
        }
        return view('dashboard.questions.questions-layout-list-graph');
    }
}