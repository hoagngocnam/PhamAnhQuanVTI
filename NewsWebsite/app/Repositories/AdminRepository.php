<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AdminRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    function list(Request $request)
    {
        $infor = $request->input('infor') ?? null;
        $sex = $request->input('sex', null);
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $sex = $sex !== null ? (int)$sex : null;
        $query = User::select()->whereIn('role', [1, 3]);
        if ($infor !== null) {
            $query->where('email', 'LIKE', "%{$infor}%");
        }
        if ($sex !== null) {
            $query->where('sex', $sex);
        }
        $users = $query->paginate($record);
        return $users;
    }

    function user(Request $request)
    {
        $infor = $request->input('infor') ?? null;
        $sex = $request->input('sex', null);
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $sex = $sex !== null ? (int)$sex : null;
        $query = User::select()->whereIn('role', [2]);
        if ($infor !== null) {
            $query->where('email', 'LIKE', "%{$infor}%");
        }
        if ($sex !== null) {
            $query->where('sex', $sex);
        }
        $users = $query->paginate($record);
        return $users;
    }

    function add($attributes)
    {
        $user = new User();
        $user->first_name = $attributes['first_name'];
        $user->last_name = $attributes['last_name'];
        $user->password = Hash::make($attributes['password']);
        $user->address = $attributes['address'];
        $user->sex = $attributes['sex'];
        $user->email = $attributes['email'];
        $user->birthday = $attributes['birthday'];
        $user->role = $attributes['role'];
        $user->avatar = $attributes['avatar'];
        $user->save();
        return $user;
    }

    function delete($id)
    {
        if (Auth::id() != $id) {
            $user = User::find($id);
            $user->delete();
        };
        return $user;
    }
    function edit($id)
    {
        $admin = $this->user->find($id);
        return $admin;
    }
}