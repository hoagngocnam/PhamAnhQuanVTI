<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use function Ramsey\Uuid\v1;

class AdminController extends Controller
{
    function list(Request $request){
        $userSex = config('global.sex');
        $userRole = config('global.role');
        $infor = $request->input('infor') ?? null;
        $sex = $request->sex ?? null;

        $query = User::select();
        if ($infor !== null) {
            $query->where('email','LIKE',"%{$infor}%");
        }
        if ($sex !== null) {
            $query->where('sex',$sex);
        }
        $users = $query->paginate(7);
        return view('admin.list',compact('users','userSex','userRole'));
    }
    function add(){
        $user = Auth::user();
        return view('admin.add',compact('user'));
    }
    function store(Request $request){
        $request->validate(
        [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:100','min:10', 'unique:users'],
            'password' => ['required', 'string', 'min:10', 'confirmed','regex: "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,50}$"'],
            'sex' => 'required',
            'role' => 'required',
            'avatar' => ['mimes:jpeg,jpg,png,gif','required','max:10000']

        ]);
        $name = $request->file('avatar')->store('uploads/avatar');

        $user =  User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'address' => $request['address'],
            'sex' => $request['sex'],
            'birthday' => $request['birthday'],
            'role' => $request['role'],
            'avatar'=> $name
        ]);

        return redirect('admin/list')->with('status','Tài khoản đã được thêm mới !');
    }
    function delete($id){
        if(Auth::id()!=$id){
            $user = User::find($id);
            $user->delete();
            return redirect('admin/list')->with('danger','Tài khoản đã được xóa !');
        }
    }
    function edit($id){
        $user = User::find($id);
        return view('admin/edit',compact('user'));
    }
    function update(Request $request, $id){
        $user = User::find($id);
        if($user->avatar){
            $request->validate(
                [
                    'first_name' => ['required', 'string', 'max:50'],
                    'last_name' => ['required', 'string', 'max:50'],
                    'password' => ['required', 'string', 'min:10', 'confirmed','regex: "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,50}$"'],
                    'sex' => 'required',
                    'role' => 'required',
                    'avatar' => ['mimes:jpeg,jpg,png,gif','max:10000']
        
                ]);
                User::where('id',$id)->update([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'password' => Hash::make($request['password']),
                    'address' => $request['address'],
                    'sex' => $request['sex'],
                    'birthday' => $request['birthday'],
                    'role' => $request['role'], 
                ]); 
        }
        else{
            $request->validate(
                [
                    'first_name' => ['required', 'string', 'max:50'],
                    'last_name' => ['required', 'string', 'max:50'],
                    'password' => ['required', 'string', 'min:10', 'confirmed','regex: "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,50}$"'],
                    'sex' => 'required',
                    'role' => 'required',
                    'avatar' => ['mimes:jpeg,jpg,png,gif','required','max:10000']
        
                ]);
                $name = $request->file('avatar')->store('uploads/avatar');
                User::where('id',$id)->update([
                    'first_name' => $request['first_name'],
                    'last_name' => $request['last_name'],
                    'password' => Hash::make($request['password']),
                    'address' => $request['address'],
                    'sex' => $request['sex'],
                    'birthday' => $request['birthday'],
                    'role' => $request['role'], 
                    'avatar'=> $name
                ]); 
        }    
                   
            return redirect('admin/list')->with('status','Tài khoản đã được chỉnh sửa !');
    }

}