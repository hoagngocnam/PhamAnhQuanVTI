<?php

namespace App\Services;

use App\Providers\HelperServiceProvider;
use App\User;
use App\Repositories\AdminRepository;
use App\Helpers;
use App\Posts;
use Illuminate\Http\Request;

class AdminService
{
    protected $adminRepository;
    public function __construct(AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function listAdmin($admin)
    {
        $admin = $this->adminRepository->list($admin);
        return $admin;
    }

    public function user($admin)
    {
        $admin = $this->adminRepository->user($admin);
        return $admin;
    }

    public function addAdmin($attributes)
    {
        $admin =  $this->adminRepository->add($attributes);
        return $admin;
    }

    public function deleteAdmin($id)
    {
        return $this->adminRepository->delete($id);
    }

    public function editAdmin($id)
    {
        return $this->adminRepository->edit($id);
    }
}