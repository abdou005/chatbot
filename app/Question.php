<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @property string question
 * @property string response
 * @property integer type
 * @property integer group_id
 *
 * @package App
 */
class Question extends Model
{

    const NOT_USED = 0, USED = 1;
    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
