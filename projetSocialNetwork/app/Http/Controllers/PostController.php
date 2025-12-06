<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post=Post::With('author')->get();
        return response()->json($post);
    }

    public function poster(Request $request){
        $data = $request->validate([
            'content' => 'required|string',
        ]);

        $user_id = auth()->user()->id;
        $post = Post::create([
            'user_id' => $user_id,
            'content' => $data['content'],
        ]);
        return response()->json([
            'message' => 'Post creee avec succes',
            'post' => $post,
        ],201);
    }

    public function likes($post_id){
        $user_id = auth()->user()->id;
        Like::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
        ]);
        return response()->json([
            'message' => "Post $post_id liked by user $user_id",
        ], 200);
    }

}
