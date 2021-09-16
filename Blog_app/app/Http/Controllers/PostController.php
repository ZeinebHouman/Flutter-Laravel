<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //get all posts
    public function index()
    {
        return response ([

            "posts" => Post::orderBy("created_at","desc")->with('user:id,name,image')->withCount('comments,likes')->get()
        ], 200);
    }

    //get single post
    public function show($id){
        return response ([
            "post" =>Post::where('id',$id)->withCount('comments,likes')->get()
        ]);

    }
    //create Post
    public function store(Request $request)
    {
        $attrs=$request->validate([
            'body' =>'required | string'
        ]);
        $post=Post::create([
            'body' => $attrs('body'),
            'user_id'=> auth()->user()->id
        ]);

        return response ([
        'message' => "Post created",
        "post" => $post

        ],200);

    }
}
