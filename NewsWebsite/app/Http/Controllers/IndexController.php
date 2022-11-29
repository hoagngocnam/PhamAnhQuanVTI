<?php

namespace App\Http\Controllers;

use App\Categories;
use Illuminate\Support\Facades\Auth;
use App\Posts;
use App\Comments;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    function show(){
        $categories = Categories::all();
        $posts = Posts::orderBy('created_at', 'DESC')->get();
        $posts_hot = Posts::all()->random(4);
        $posts_popular = Posts::all();
        $posts_another = Posts::all()->random(4);
        $posts_latest1 = Posts::orderBy('created_at', 'DESC')->get();
        $posts_latest2 = Posts::orderBy('created_at', 'ASC')->get();
        $posts_recommended = Posts::all()->random(4);
        $posts_best = Posts::all()->random(6);
        // dd($posts_latest);
        return view('user.home',compact('posts_recommended','categories','posts','posts_best','posts_popular','posts_latest1','posts_latest2','posts_hot','posts_another'));
    }
    function detailPost($slug,Request $request){
        $post = Posts::where('slug','like',$slug)->first();
        $comments = Comments::all();
        $same_posts = Posts::where('categories_id','=',$post->categories_id)->get();
        return view('user.post',compact('post','same_posts','comments'));
    }
    function detailCategories($slug){
        $categories = Categories::where('slug','like',$slug)->first();
        return view('user.categories',compact('categories'));
    }
    function profile(){
        $userSex = config('global.sex');
        $user = Auth::user();
        return view('profile',compact('user','userSex'));
    }

}