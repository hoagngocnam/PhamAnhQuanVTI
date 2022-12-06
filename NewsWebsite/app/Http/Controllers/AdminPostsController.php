<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Components\Recusive;
use App\Http\Requests\StorePostRequest;
use App\Services\PostService;
use App\Posts;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminPostsController extends Controller
{
    public function __construct(PostService $postsService)
    {
        $this->postService = $postsService;
    }

    function list(Request $request)
    {
        $postStatus = config('global.hot_flag');
        $user = Auth::user();
        $categories = Categories::all();
        //
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
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $posts = $this->postService->listpost($request);
        return view('posts.list', compact('postStatus', 'hot_flag', 'user', 'posts', 'record', 'list_categories', 'categories'))->with('t', (request()->input('page', 1) - 1) * $record);
    }

    function add(Request $request)
    {
        $user = Auth::user();
        $categories = Categories::all();
        $recusive = new Recusive($categories);
        $list_categories = $recusive->showCategories();
        return view('posts.add', compact('user', 'list_categories', 'categories'));
    }

    function store(StorePostRequest $request)
    {
        $user_id = Auth::id();
        $name = $request->file('photo')->store('uploads/photo');
        $attributes = [
            'title' => $request['title'],
            'hot_flag' => $request['hot_flag'],
            'categories_id' => $request['categories_id'],
            'users_id' => $user_id,
            'content' => $request['content'],
            'post_time' => $request['post_time'],
            'photo' => $name,
            'slug' => to_slug($request['title'])
        ];
        $posts = $this->postService->addPost($attributes);
        return redirect('admin/posts/list')->with('status', 'Bài viết đã được thêm mới !');
    }

    function edit(Request $request, $id)
    {
        $post = Posts::find($id);
        $categories = Categories::all();
        $categories_id = $request->categories_id ?? 0;
        $recusive = new Recusive($categories, $categories_id);
        $list_categories = $recusive->showCategories();
        return view('posts/edit', compact('post', 'list_categories', 'categories'));
    }

    function delete($id)
    {
        $post = $this->postService->deletePost($id);
        return redirect()->back()->with('danger', 'Bài viết đã được xóa !');
    }

    function details($id)
    {
        $post = Posts::find($id);
        return view('posts/details', compact('post'));
    }

    function update(Request $request, $id)
    {
        $post = Posts::find($id);
        $categories_id = $post->categories_id;
        $slug = to_slug($request['title']);
        if ($post->photo) {
            $name = $request->file('photo') ?? null;
            if ($name == null) {
                $request->validate(
                    [
                        'title' => ['required', 'string', 'max:100'],
                        'hot_flag' => 'required',
                        'categories_id' => 'required',
                        'content' => 'required',
                        'post_time' => 'required',
                    ]
                );
                Posts::where('id', $id)->update([
                    'title' => $request['title'],
                    'hot_flag' => $request['hot_flag'],
                    'categories_id' => $categories_id,
                    'content' => $request['content'],
                    'post_time' => $request['post_time'],
                    'slug' => $slug
                ]);
            } else {
                $name = $request->file('photo')->store('uploads/photo');
                $request->validate(
                    [
                        'title' => ['required', 'string', 'max:100'],
                        'hot_flag' => 'required',
                        'categories_id' => 'required',
                        'content' => 'required',
                        'post_time' => 'required',
                        'photo' => ['mimes:jpeg,jpg,png,gif', 'required', 'max:10000']
                    ]
                );
                Posts::where('id', $id)->update([
                    'title' => $request['title'],
                    'hot_flag' => $request['hot_flag'],
                    'categories_id' => $request['categories_id'],
                    'content' => $request['content'],
                    'post_time' => $request['post_time'],
                    'photo' => $name,
                    'slug' => $slug
                ]);
            }
        } else {
            $request->validate(
                [
                    'title' => ['required', 'string', 'max:100'],
                    'hot_flag' => 'required',
                    'categories_id' => 'required',
                    'content' => 'required',
                    'post_time' => 'required',
                    'photo' => ['mimes:jpeg,jpg,png,gif', 'required', 'max:10000']
                ]
            );
            $name = $request->file('photo')->store('uploads/photo');
            Posts::where('id', $id)->update([
                'title' => $request['title'],
                'hot_flag' => $request['hot_flag'],
                'categories_id' => $request['categories_id'],
                'content' => $request['content'],
                'post_time' => $request['post_time'],
                'photo' => $name,
                'slug' => $slug
            ]);
        }
        return redirect('admin/posts/list')->with('status', 'Bài viết đã được chỉnh sửa !');
    }
}