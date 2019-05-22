<?php

namespace App\Http\Controllers\Api;

use App\Group;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{

    public function getGroups()
    {
        $groups = Group::paginate(10);
        return response()->json($groups, 200);
    }
}