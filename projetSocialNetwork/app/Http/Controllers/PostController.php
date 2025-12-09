<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $post=Post::With('author')->withCount('likes')->get();
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

    public function comments(Request $request){
        $user_id = auth()->user()->id;
        $comments = Comment::create([
            'user_id' => $user_id, 
            'post_id' => $request->post_id,
            'content' => $request->content,
        ]);
    }

    public function getComments($post_id){
        $comments = Comment::with('user')->where('post_id', $post_id)->latest()->get();
        return response()->json($comments);
    }

}
