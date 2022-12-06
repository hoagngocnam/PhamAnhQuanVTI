<?php

namespace App\Repositories;

use App\Categories;
use Illuminate\Http\Request;

class CategoriesRepository
{
    protected $categories;

    public function __construct(Categories $categories)
    {
        $this->categories = $categories;
    }

    function getAll()
    {
        $categories = Categories::all();
        return $categories;
    }

    function list(Request $request)
    {
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $infor = "";
        if ($request->input('infor')) {
            $infor = $request->input('infor');
        }
        $categories = Categories::where('name', 'like', "%{$infor}%")->paginate($record);
        return $categories;
    }

    function add($attributes)
    {
        $categories = new Categories();
        $categories->name = $attributes['name'];
        $categories->slug = $attributes['slug'];
        $categories->save();
        return $categories;
    }

    function delete($id)
    {
        $categories = Categories::find($id);
        $categories->delete();
        return $categories;
    }

    function edit($id)
    {
        $categories = $this->categories->find($id);
        return $categories;
    }

    function update($attributes, $id)
    {
        $categories = $this->categories->find($id);
        $categories->name = $attributes['name'];
        $categories->slug = $attributes['slug'];
        $categories->update();
        return $categories;
    }
}