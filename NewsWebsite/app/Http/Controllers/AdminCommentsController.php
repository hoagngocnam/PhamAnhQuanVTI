<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Categories;
use App\Components\Recusive;
use App\Posts;
use App\Services\CommentService;
use App\User;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    function list(Request $request)
    {
        $commentStatus = config('global.status');
        $user = User::all();
        $post = Posts::all();
        $user_name = $request->input('user_name') ?? null;
        $record = $request->input('record') ?? null;
        if ($record == null) {
            $record = 7;
        }
        $status = $request->input('status', null);
        $status = $status !== null ? (int)$status : null;
        $comments = $this->commentService->listcomment($request);
        return view('comments.list', compact('commentStatus', 'comments', 'status', 'user', 'post'))->with('t', (request()->input('page', 1) - 1) * $record);
    }
    function edit($id)
    {
        $comment = $this->commentService->editComment($id);
        return redirect()->back();
    }
    function active()
    {
        $comment = $this->commentService->activeComment();
        return redirect('admin/comments/list');
    }
    function details($id)
    {
        $comment = $this->commentService->detailsComment($id);
        return view('comments.details', compact('comment'));
    }
    function delete($id)
    {
        $comment = $this->commentService->deleteComment($id);
        return redirect('admin/comments/list')->with('danger', 'Comment đã được xóa !');
    }
}