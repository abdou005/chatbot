<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $image
     * @return User
     */
    public static function createUser($firstName, $lastName, $email, $password, $image){
        $user = new User();
        $user->first_name = $firstName;
        $user->last_name = $lastName;
        $user->email = $email;
        $user->password =  Hash::make($password);
        $user->image = $image;
        $user->save();
        $token = JWTAuth::fromUser($user);
        $user->token = $token;
        $user->save();
        return $user;
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $image
     * @param string $email
     * @return User
     */
    public function updateUser($firstName, $lastName, $email, $image)
    {
        $this->user->first_name = $firstName;
        $this->user->last_name = $lastName;
        $this->user->image = $image;
        $this->user->email = $email;
        $this->user->save();
        return $this->user;
    }

    /**
     * @param string|null $name
     * @param bool $pagination
     * @param integer $start
     * @param integer $length
     * @return LengthAwarePaginator|Collection
     */
    public static function searchUsersByFilter($name = null, $pagination = false, $start = 0, $length = 10){
        $users = User::orderBy('created_at', 'desc')->where('role', '!=', User::ADMIN);
        if ($name) {
            $users = $users->where('first_name','like','%'.$name.'%')
                ->orWhere('last_name','like','%'.$name.'%')
                ->orWhere('email','like','%'.$name.'%');
        }
        if($pagination){
            $page=$start/$length+1;
            $users = $users->paginate($length, ['*'], $start, $page);
        } else {
            $users = $users->get();
        }
        return $users;
    }
}