<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('user')
        ->where('published_at', '<=', Carbon::now())
        ->get();
        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $post = Post::create([
            'user_id' => Auth::user()->id,
            'published_at' => $request['published_at'],
            'title' => $request['title'],
            'slug' => $request['slug'],
            'excerpt' => $request['excerpt'],
            'body' => $request['body'],
        ]);
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        if (!$post->published_at || $post->published_at->gt(Carbon::now())){
            return response()->json(['error' => 'Post not found or not published']);
        }

        $post->load('user');
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Post $post)
    {
        if(Auth::user()->cant('update', $post)){
            return response()->json(['error' => 'You cant update this post or no index post']);
        }

        $post->update([
            'published_at' => $request['published_at'],
            'title' => $request['title'],
            'slug' => $request['slug'],
            'excerpt' => $request['excerpt'],
            'body' => $request['body'],
        ]);
        
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(Auth::user()->cant('update', $post)){
            return response()->json(['error' => 'You cant update this post or no index post']);
        }

        $post->delete();

        return response()->json('Post was deleted', 201);
    }
}
