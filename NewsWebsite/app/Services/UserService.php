<?php

namespace App\Services;

use App\Providers\HelperServiceProvider;
use App\User;
use App\Repositories\UserRepository;
use App\Helpers;
use App\Posts;
use Illuminate\Http\Request;

class UserService
{
    protected $adminRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function registerUser($user)
    {
        return $this->userRepository->register($user);
    }
}