<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Support\Facades\Auth;
use App\Posts;
use App\Comments;
use App\Services\IndexPostService;
use Illuminate\Http\Request;
use App\Services\CategoriesService;
use App\Services\PostService;

class IndexController extends Controller
{

    public function __construct(PostService $postService, CategoriesService $categoriesService)
    {
        $this->postService = $postService;
        $this->categoriesService = $categoriesService;
    }

    function show()
    {
        $categories = $this->categoriesService->getAll();
        $posts = $this->postService->showPosts();
        $posts_hot = $this->postService->posts_hot();
        $posts_popular = $this->postService->posts_popular();
        $posts_another = $this->postService->posts_another();
        $posts_latest1 = $this->postService->posts_latest1();
        $posts_latest2 = $this->postService->posts_latest2();
        $posts_recommended = $this->postService->posts_recommended();
        $posts_best = $this->postService->posts_best();
        return view('user.home', compact('posts_recommended', 'categories', 'posts', 'posts_best', 'posts_popular', 'posts_latest1', 'posts_latest2', 'posts_hot', 'posts_another'));
    }
    function detailPost($slug, Request $request)
    {
        $post = Posts::where('slug', 'like', $slug)->first();
        $comments = Comments::all();
        $same_posts = Posts::where('categories_id', '=', $post->categories_id)->get();
        return view('user.post', compact('post', 'same_posts', 'comments'));
    }
    function detailCategories($slug)
    {
        $categories = Categories::where('slug', 'like', $slug)->first();
        return view('user.categories', compact('categories'));
    }
    function profile()
    {
        $userSex = config('global.sex');
        $user = Auth::user();
        return view('profile', compact('user', 'userSex'));
    }
}