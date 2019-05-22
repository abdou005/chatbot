<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @property string first_name
 * @property string last_name
 * @property integer role
 * @property string image
 * @property string email
 * @property string password
 *
 * @package App
 */
class User extends Authenticatable
{
    CONST ADMIN = 1, VISITOR = 2;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'image', 'email', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public static function findByEmail($email)
    {
        return self::where('email', $email)->first();
    }

    public static function findByToken($token)
    {
        return self::where('token', $token)->first();
    }

}
