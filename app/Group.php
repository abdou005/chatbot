<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Group
 * @property string title
 * @property string desc
 *
 * @package App
 */
class Group extends Model
{

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
