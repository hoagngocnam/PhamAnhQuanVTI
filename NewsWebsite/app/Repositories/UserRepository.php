<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    function register($attributes)
    {
        $user = new User();
        $user->first_name = $attributes['first_name'];
        $user->last_name = $attributes['last_name'];
        $user->password = Hash::make($attributes['password']);
        $user->address = $attributes['address'];
        $user->sex = $attributes['sex'];
        $user->email = $attributes['email'];
        $user->role = '2';
        $user->save();
        return $user;
    }
}