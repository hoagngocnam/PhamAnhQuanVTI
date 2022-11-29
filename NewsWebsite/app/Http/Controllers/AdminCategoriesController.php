<?php

namespace App\Http\Controllers;
use App\Providers\HelperServiceProvider;
use App\Categories;
use App\Helpers;
use App\Posts;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    
    function list(Request $request){
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $infor = "";
            if ($request->input('infor')) {
                $infor = $request->input('infor');
            }
            $categories = Categories::where('name', 'like', "%{$infor}%")->paginate($record);
        return view('categories.list', compact('categories'))->with('t', (request()->input('page', 1) - 1) * $record);
    }
    function add(){
        return view('categories.add');
    }
    function store(Request $request){
        $request->validate(
            [
                'name' => ['required', 'string', 'max:100'],   
            ]);
            $slug = to_slug($request['name']);
        $categories =  Categories::create([
                'name' => $request['name'],  
                'slug' => $slug         
            ]);
            return redirect('admin/categories/list')->with('status','Danh mục '. $categories->name.' đã thêm mới !');
    }  
    function delete($id){
            $categories = Categories::find($id);
            $categories->delete();
            return redirect()->back()->with('danger','Danh mục '. $categories->name.' đã được xóa !');
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
            $slug = to_slug($request['name']);
        $categories = Categories::where('id',$id)->update([
                'name' => $request['name'],    
                'slug' => $slug           
            ]);
            return redirect('admin/categories/list')->with('status','Danh mục đã được sửa !');
    }
    function show($id){
        $categories_id = Categories::find($id);
        $query = Posts::select();
        $query->where('categories_id',$categories_id);
        $posts = $query;
        return view('posts/list',compact('posts'));
    }
}