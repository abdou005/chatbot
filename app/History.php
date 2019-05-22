<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * @property integer question_id
 * @property integer user_id
 *
 * @package App
 */
class History extends Model
{

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
