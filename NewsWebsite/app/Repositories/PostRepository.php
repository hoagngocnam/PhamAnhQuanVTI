<?php

namespace App\Repositories;

use App\Posts;
use Illuminate\Support\Facades\Auth;
use App\Categories;
use Illuminate\Http\Request;
use App\Components\Recusive;

class PostRepository
{
    protected $post;

    public function __construct(Posts $post)
    {
        $this->post = $post;
    }

    function list(Request $request)
    {
        //
        $categories = Categories::all();
        $title = $request->input('title') ?? null;
        $user_name = $request->input('user_name') ?? null;
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $hot_flag = $request->input('hot_flag', null);
        $hot_flag = $hot_flag !== null ? (int)$hot_flag : null;
        $categories_id = $request->categories_id ?? 0;
        $recusive = new Recusive($categories, $categories_id);
        $list_categories = $recusive->showCategories();
        //
        $query = (Posts::select('posts.*')->join('users', 'users.id', '=', 'posts.users_id'));

        if ($title !== null) {
            $query->where('title', 'LIKE', "%{$title}%");
        }
        if ($user_name !== null) {
            $query->where('users.last_name', 'LIKE', "%{$user_name}%");
        }

        if ($hot_flag !== null) {
            $query->where('hot_flag', $hot_flag);
        }
        if ($categories_id != 0) {
            $query->where('categories_id', $categories_id);
        }

        $posts = $query->paginate($record);
        return $posts;
    }

    function add($attributes)
    {
        $post = new Posts();
        $user_id = Auth::id();
        $post->title = $attributes['title'];
        $post->hot_flag = $attributes['hot_flag'];
        $post->categories_id = $attributes['categories_id'];
        $post->users_id = $user_id;
        $post->content = $attributes['content'];
        $post->post_time = $attributes['post_time'];
        $post->photo = $attributes['photo'];
        $post->slug = to_slug($attributes['title']);
        $post->save();
        return $post;
    }

    function delete($id)
    {
        $post = Posts::find($id);
        $post->delete();
        return $post;
    }

    function posts()
    {
        $posts = Posts::orderBy('created_at', 'DESC')->get();
        return $posts;
    }

    function posts_hot()
    {
        $posts_hot = Posts::all()->random(4);
        return $posts_hot;
    }

    function posts_popular()
    {
        $posts_popular = Posts::all();
        return $posts_popular;
    }

    function posts_latest1()
    {
        $posts_latest1 = Posts::orderBy('created_at', 'DESC')->get();
        return $posts_latest1;
    }

    function posts_latest2()
    {
        $posts_latest2 = Posts::orderBy('created_at', 'ASC')->get();
        return $posts_latest2;
    }

    function posts_another()
    {
        $posts_another = Posts::all()->random(4);
        return $posts_another;
    }

    function posts_recommended()
    {
        $posts_recommended = Posts::all()->random(4);
        return $posts_recommended;
    }

    function posts_best()
    {
        $posts_best = Posts::all()->random(6);
        return $posts_best;
    }
}