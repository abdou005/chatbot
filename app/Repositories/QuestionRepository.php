<?php

namespace App\Repositories;

use App\Group;
use App\Question;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class QuestionRepository
{
    /**
     * @var Question
     */
    private $question;

    /**
     * UserRepository constructor.
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * @param string $questionTxt
     * @param string $response
     * @param Group $group
     * @param integer type
     * @return Question $question
     */
    public static function createQuestion($questionTxt, $response, Group $group, $type = Question::USED): Question
    {
        $question = new Question();
        $question->question = $questionTxt;
        $question->response = $response;
        $question->type = $type;
        $question->group_id = $group->id;
        $question->save();
        return $question;
    }


    /**
     * @param string $questionTxt
     * @param string $response
     * @param Group $group
     * @return Question $question
     */
    public function updateQuestion($questionTxt, $response, $group = null)
    {
        $this->question->question = $questionTxt;
        $this->question->response = $response;
        if ($group) {
            $this->question->group_id = $group->id;
        }
        $this->question->save();
        return $this->question;
    }

    /**
     * @param string|null $name
     * @param bool $pagination
     * @param integer $start
     * @param integer $length
     * @return LengthAwarePaginator|Collection
     */
    public static function searchQuestionsByFilter($name = null, $pagination = false, $start = 0, $length = 10)
    {
        $questions = Question::orderBy('created_at', 'desc')->where('type', '=' , Question::USED)->with('group');
        if ($name) {
            $questions = $questions->where('question', 'like', '%' . $name . '%')
                ->orWhere('response', 'like', '%' . $name . '%');
        }
        if ($pagination) {
            $page = $start / $length + 1;
            $questions = $questions->paginate($length, ['*'], $start, $page);
        } else {
            $questions = $questions->get();
        }
        return $questions;
    }
}