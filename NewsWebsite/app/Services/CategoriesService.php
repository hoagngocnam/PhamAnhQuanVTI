<?php

namespace App\Services;

use App\Providers\HelperServiceProvider;
use App\Categories;
use App\Repositories\CategoriesRepository;
use App\Helpers;
use App\Posts;
use Illuminate\Http\Request;

class CategoriesService
{
    protected $categoriesRepository;
    public function __construct(CategoriesRepository $categoriesRepository)
    {
        $this->categoriesRepository = $categoriesRepository;
    }

    public function getAll()
    {
        return $categories = $this->categoriesRepository->getAll();
    }

    public function listCategories($categories)
    {
        $categories = $this->categoriesRepository->list($categories);
        return $categories;
    }

    public function addCategories($attributes)
    {
        return $this->categoriesRepository->add($attributes);
    }

    public function deleteCategories($id)
    {
        return $this->categoriesRepository->delete($id);
    }

    public function editCategories($id)
    {
        return $this->categoriesRepository->edit($id);
    }

    public function updateCategories($attributes, $id)
    {
        return $this->categoriesRepository->update($attributes, $id);
    }
}