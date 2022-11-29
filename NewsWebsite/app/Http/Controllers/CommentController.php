<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Comments;
use Illuminate\Support\Facades\Auth;
use App\Posts;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Support\Facades\Response;

class CommentController extends Controller
{
    /**       
         * Display a listing of the resource.
         *
         * @param  Illuminate\Http\Request $request
         * @return Response
         */
    public function addComment(Request $request, $id)
	{
        $request->validate([ 'message' => 'required', ]);
        $post_id = Posts::find($id);
        $comment = new Comments();
        $comment->comment = $request->input('message');
        $comment->user_id = Auth::id();
        $comment->post_id = $id;
        // $comment->parent_id = $request['parent_id'];
        $comment->save($request->all());
        $comment->user; 
        return response()->json($comment);

	}
    public function storeComment(Request $request, $id)
	{
        $post_id = Posts::find($id);
        $comment_reply = new Comments();
        $comment_reply->comment = $request->input('message');
        $comment_reply->user_id = Auth::id();
        $comment_reply->post_id = $id;
        $comment_reply->parent_id = $request['parent_id'];
        $comment_reply->save($request->all());
        $comment_reply->user; 
        return back();

	}
}