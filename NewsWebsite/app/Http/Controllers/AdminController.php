<?php

namespace App\Http\Controllers;

use App\User;
use RealRashid\SweetAlert\Facades\Aler;
use Alert;
use App\Http\Requests\StoreAdminRequest;
use App\Services\AdminService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use function Ramsey\Uuid\v1;

class AdminController extends Controller
{
    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    function profile()
    {
        $userSex = config('global.sex');
        $user = Auth::user();
        return view('admin.profile', compact('user', 'userSex'));
    }
    function list(Request $request)
    {
        $user_role = Auth::user();
        $userSex = config('global.sex');
        $sex = $request->input('sex', null);
        $sex = $sex !== null ? (int)$sex : null;
        $userRole = config('global.role');
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $users = $this->adminService->listAdmin($request);
        return view('admin.list', compact('users', 'record', 'userSex', 'userRole', 'user_role', 'sex'))->with('t', (request()->input('page', 1) - 1) * $record);
    }
    function user(Request $request)
    {
        $userSex = config('global.sex');
        $userRole = config('global.role');
        $infor = $request->input('infor') ?? null;
        $sex = $request->input('sex', null);
        $sex = $sex !== null ? (int)$sex : null;
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $users = $this->adminService->user($request);
        return view('admin.user', compact('users', 'userSex', 'record', 'userRole', 'sex'))->with('t', (request()->input('page', 1) - 1) * $record);
    }

    function add()
    {
        $user = Auth::user();
        return view('admin.add', compact('user'));
    }

    function store(StoreAdminRequest $request)
    {
        $name = $request->file('avatar')->store('uploads/avatar');
        $attributes = [
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'address' => $request['address'],
            'sex' => $request['sex'],
            'birthday' => $request['birthday'],
            'role' => $request['role'],
            'avatar' => $name
        ];
        $user = $this->adminService->addAdmin($attributes);
        if ($user->role == 2) {
            return redirect('admin/user')->with('status', 'Tài khoản ' . $user->email . ' đã được thêm mới !');
        }
        return redirect('admin/list')->with('status', 'Tài khoản ' . $user->email . ' đã được thêm mới !');
    }

    function delete($id)
    {
        $user = $this->adminService->deleteAdmin($id);
        if ($user->role == 2) {
            return redirect('admin/user')->with('danger', 'Tài khoản ' . $user->email . ' đã được xóa !');
        }
        return redirect()->back()->with('danger', 'Tài khoản ' . $user->email . ' đã được xóa !');
    }

    function edit($id)
    {
        $user_role = Auth::user();
        $user = $this->adminService->editAdmin($id);
        return view('admin/edit', compact('user', 'user_role'));
    }

    function update(Request $request, $id)
    {
        $user = User::find($id);
        if ($user->avatar) {
            $name = $request->file('avatar') ?? null;
            if ($name == null) {
                $request->validate(
                    [
                        'first_name' => ['required', 'string', 'max:50'],
                        'last_name' => ['required', 'string', 'max:50'],
                        'password' => ['required', 'string', 'min:10', 'confirmed', 'regex: "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,50}$"'],
                        'sex' => 'required|integer|max:2',
                        'role' => 'required',

                    ]
                );
                User::where('id', $id)->update([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'password' => Hash::make($request['password']),
                    'address' => $request['address'],
                    'sex' => $request['sex'],
                    'birthday' => $request['birthday'],
                    'role' => $request['role'],

                ]);
            } else {
                $name = $request->file('avatar')->store('uploads/avatar');
                $request->validate(
                    [
                        'first_name' => ['required', 'string', 'max:50'],
                        'last_name' => ['required', 'string', 'max:50'],
                        'password' => ['required', 'string', 'min:10', 'confirmed', 'regex: "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,50}$"'],
                        'sex' => 'required|integer|max:2',
                        'role' => 'required',
                        'avatar' => ['mimes:jpeg,jpg,png,gif', 'required', 'max:10000']

                    ]
                );
                User::where('id', $id)->update([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'password' => Hash::make($request['password']),
                    'address' => $request['address'],
                    'sex' => $request['sex'],
                    'birthday' => $request['birthday'],
                    'role' => $request['role'],
                    'avatar' => $name
                ]);
            }
        } else {
            $request->validate(
                [
                    'first_name' => ['required', 'string', 'max:50'],
                    'last_name' => ['required', 'string', 'max:50'],
                    'password' => ['required', 'string', 'min:10', 'confirmed', 'regex: "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,50}$"'],
                    'sex' => 'required|integer|max:2',
                    'role' => 'required',
                    'avatar' => ['mimes:jpeg,jpg,png,gif', 'required', 'max:10000']

                ]
            );
            $name = $request->file('avatar')->store('uploads/avatar');
            $user = User::where('id', $id)->update([
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'password' => Hash::make($request['password']),
                'address' => $request['address'],
                'sex' => $request['sex'],
                'birthday' => $request['birthday'],
                'role' => $request['role'],
                'avatar' => $name
            ]);
        }
        if ($user->role == 2) {
            return redirect('admin/user')->with('status', 'Tài khoản ' . $user->email . ' đã được chỉnh sửa !');
        }
        return redirect('admin/list')->with('status', 'Tài khoản ' . $user->email . ' đã được chỉnh sửa !');
    }
}