<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comments;
use App\Services\CommentService;
use Illuminate\Support\Facades\Auth;
use App\Posts;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }
    /**       
     * Display a listing of the resource.
     *
     * @param  Illuminate\Http\Request $request
     * @return Response
     */
    public function addComment(Request $request, $id)
    {
        $request->validate(['message' => 'required',]);
        // $attributes = $request->input('message');
        $comment = $this->commentService->addComment($request, $id);
        $comment->user;
        return response()->json($comment);
    }

    public function storeComment(Request $request, $id)
    {
        $request->validate(['message' => 'required',]);
        $attributes = $request->input('message');
        $attributes = $request->input('parent_id');
        $comment_reply = $this->commentService->storeComment($request, $id);
        $comment_reply->user;
        return response()->json($comment_reply);
    }
}