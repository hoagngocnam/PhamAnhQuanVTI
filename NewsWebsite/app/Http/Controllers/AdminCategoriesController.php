<?php

namespace App\Http\Controllers;
use App\Providers\HelperServiceProvider;
use App\Services\CategoriesService;
use App\Categories;
use App\Helpers;
use App\Http\Requests\StoreCategoriesRequest;
use App\Posts;
use Illuminate\Http\Request;

class AdminCategoriesController extends Controller
{
    public function __construct(CategoriesService $categoriesService)
    {
        $this->categoriesService = $categoriesService;
    }
    
    function list(Request $request){
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $categories = $this->categoriesService->listCategories($request);
        return view('categories.list', compact('categories'))->with('t', (request()->input('page', 1) - 1) * $record);
    }

    function add(){
        return view('categories.add');
    }

    function store(StoreCategoriesRequest $request){
        $attributes = [
            'name' => $request['name'], 
            'slug' => to_slug($request['name']),
        ];
        $categories = $this->categoriesService->addCategories($attributes);
        return redirect('admin/categories/list')->with('status','Danh mục '. $categories->name.' đã thêm mới !');
    }

    function delete($id){
        $categories = $this->categoriesService->deleteCategories($id);  
        return redirect()->back()->with('danger','Danh mục '. $categories->name.' đã được xóa !');
    }
    function edit($id){
        $categories = $this->categoriesService->editCategories($id);
        return view('categories/edit',compact('categories'));
    }
    function update(StoreCategoriesRequest $request, $id){
        $attributes = [
                'name' => $request['name'],    
                'slug' => to_slug($request['name']),
            ];
            $categories = $this->categoriesService->updateCategories($attributes, $id);
            return redirect('admin/categories/list')->with('status','Danh mục đã được sửa !');
    }
}