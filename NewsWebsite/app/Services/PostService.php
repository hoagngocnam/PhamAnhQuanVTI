<?php

namespace App\Services;

use App\Providers\HelperServiceProvider;
use App\Categories;
use App\Repositories\PostRepository;
use App\Helpers;
use App\Post;
use Illuminate\Http\Request;

class PostService
{
    protected $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function listPost($post)
    {
        $post = $this->postRepository->list($post);
        return $post;
    }

    public function addPost($attributes)
    {
        return $this->postRepository->add($attributes);
    }

    public function deletePost($id)
    {
        return $this->postRepository->delete($id);
    }

    public function showPosts()
    {
        return $this->postRepository->posts();
    }

    public function posts_hot()
    {
        return $this->postRepository->posts_hot();
    }

    public function posts_popular()
    {
        return $this->postRepository->posts_popular();
    }

    public function posts_another()
    {
        return $this->postRepository->posts_another();
    }

    public function posts_latest1()
    {
        return $this->postRepository->posts_latest1();
    }

    public function posts_latest2()
    {
        return $this->postRepository->posts_latest2();
    }

    public function posts_recommended()
    {
        return $this->postRepository->posts_recommended();
    }

    public function posts_best()
    {
        return $this->postRepository->posts_best();
    }
}