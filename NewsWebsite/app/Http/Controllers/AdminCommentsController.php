<?php

namespace App\Http\Controllers;
use App\Comments;
use App\Categories;
use App\Components\Recusive;
use App\Posts;
use App\User;
use Egulias\EmailValidator\Warning\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminCommentsController extends Controller
{
    function list(Request $request){
        $commentStatus = config('global.status');
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
            $query->where('users.last_name','LIKE',"%{$user_name}%");
        }
        if ($title !== null) {
            $query->where('posts.title','LIKE',"%{$title}%");
        }
        if ($status !== null) {
            $query->where('comments.status',$status);
        }
        // dd($query->get());
        $comments = $query->paginate($record);
        return view('comments.list',compact('commentStatus','comments','status','user','post'))->with('t', (request()->input('page', 1) - 1) * $record);
    }
    function edit($id){
        $comment = Comments::find($id);
        if($comment->status == 0){
            Comments::where('id',$id)->update([
                'status' => '1',
            ]);
        };
        if($comment->status == 1){
            Comments::where('id',$id)->update([
                'status' => '0',
            ]);
        };
        return redirect('admin/comments/list');
    }
    function active(){
        Comments::query()->update(['status' => 1]);
        return redirect('admin/comments/list');
    }
    function details($id){
        $comment = Comments::find($id);
        return view('comments.details',compact('comment'));
    }
    function delete($id){
        $comment = Comments::find($id);
        $comment->delete();
        return redirect('admin/comments/list')->with('danger','Comment đã được xóa !');
    }
}