<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 * @property string question
 * @property string response
 * @property integer group_id
 *
 * @package App
 */
class Question extends Model
{

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
