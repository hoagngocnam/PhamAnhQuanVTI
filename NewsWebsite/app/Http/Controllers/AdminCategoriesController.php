<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    function list(Request $request){
        $infor = "";
            if ($request->input('infor')) {
                $infor = $request->input('infor');
            }
            $categories = Categories::where('name', 'like', "%{$infor}%")->paginate(5);
        return view('categories.list', compact('categories'));
    }
    function add(){
        return view('categories.add');
    }
    function store(Request $request){
        $request->validate(
            [
                'name' => ['required', 'string', 'max:100'],   
            ]);
        $categorie =  Categories::create([
                'name' => $request['name'],              
            ]);
            return redirect('admin/categories/list')->with('status','Danh mục đã thêm mới !');
    }  
    function delete($id){
            $categories = Categories::find($id);
            $categories->delete();
            return redirect('admin/categories/list')->with('danger','Danh mục đã được xóa !');
    }
    function edit($id){
        $categories = Categories::find($id);
        return view('categories/edit',compact('categories'));
    }
    function update(Request $request, $id){
        $request->validate(
            [
                'name' => ['required', 'string', 'max:100'],   
            ]);
        Categories::where('id',$id)->update([
                'name' => $request['name'],              
            ]);
            return redirect('admin/categories/list')->with('status','Danh mục đã được sửa !');
    }
}