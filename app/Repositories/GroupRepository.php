<?php

namespace App\Repositories;

use App\Group;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GroupRepository
{
    /**
     * @var Group
     */
    private $group;

    /**
     * UserRepository constructor.
     * @param Group $group
     */
    public function __construct(Group $group)
    {
        $this->group = $group;
    }

    /**
     * @param string $title
     * @param string $desc
     * @return Group $group
     */
    public static function createGroup($title, $desc): Group
    {
        $group = new Group();
        $group->title = $title;
        $group->desc = $desc;
        $group->save();
        return $group;
    }

    /**
     * @param string $title
     * @param string $desc
     * @return Group
     */
    public function updateGroup($title, $desc)
    {
        $this->group->title = $title;
        $this->group->desc = $desc;
        $this->group->save();
        return $this->group;
    }

    /**
     * @param string|null $name
     * @param bool $pagination
     * @param integer $start
     * @param integer $length
     * @return LengthAwarePaginator|Collection
     */
    public static function searchGroupsByFilter($name = null, $pagination = false, $start = 0, $length = 10)
    {
        $groups = Group::orderBy('created_at', 'desc')->withCount('questions');
        if ($name) {
            $groups = $groups->where('title', 'like', '%' . $name . '%')
                ->orWhere('desc', 'like', '%' . $name . '%');
        }
        if ($pagination) {
            $page = $start / $length + 1;
            $groups = $groups->paginate($length, ['*'], $start, $page);
        } else {
            $groups = $groups->get();
        }
        return $groups;
    }
}