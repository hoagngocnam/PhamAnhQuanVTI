<?php

namespace App\Repositories;

use App\Comments;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Posts;
use Illuminate\Http\Request;

class CommentRepository
{
    protected $comment;

    public function __construct(Comments $comment)
    {
        $this->comments = $comment;
    }

    function list(Request $request)
    {
        $user = User::all();
        $post = Posts::all();
        $user_name = $request->input('user_name') ?? null;
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $title = $request->input('title') ?? null;
        $status = $request->input('status', null);
        $status = $status !== null ? (int)$status : null;
        $query = Comments::select('comments.*')->join('users', 'users.id', '=', 'comments.user_id')
            ->join('posts', 'posts.id', '=', 'comments.post_id');
        if ($user_name !== null) {
            $query->where('users.last_name', 'LIKE', "%{$user_name}%");
        }
        if ($title !== null) {
            $query->where('posts.title', 'LIKE', "%{$title}%");
        }
        if ($status !== null) {
            $query->where('comments.status', $status);
        }
        $comments = $query->paginate($record);
        return $comments;
    }

    function edit($id)
    {
        $comment = Comments::find($id);
        if ($comment->status == 0) {
            Comments::where('id', $id)->update([
                'status' => '1',
            ]);
        };
        if ($comment->status == 1) {
            Comments::where('id', $id)->update([
                'status' => '0',
            ]);
        };
        return $comment;
    }

    function active()
    {
        Comments::query()->update(['status' => 1]);
        return true;
    }

    function delete($id)
    {
        $comment = Comments::find($id);
        $comment->delete();
        return $comment;
    }

    function details($id)
    {
        $comment = Comments::find($id);
        return $comment;
    }

    function add($attributes, $id)
    {
        $post_id = Posts::find($id);
        $comment = new Comments();
        $comment->comment = $attributes['message'];
        $comment->user_id = Auth::id();
        $comment->post_id = $id;
        $comment->save();
        return $comment;
    }

    function store($attributes, $id)
    {
        $post_id = Posts::find($id);
        $comment_reply = new Comments();
        $comment_reply->comment = $attributes['message'];
        $comment_reply->user_id = Auth::id();
        $comment_reply->post_id = $id;
        $comment_reply->parent_id = $attributes['parent_id'];
        $comment_reply->save();
        return $comment_reply;
    }
}