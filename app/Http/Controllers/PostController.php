<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->withCount('comments')->latest()->get();
        return view('homepage', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        Auth::user()->posts()->create($validated);

        return redirect()->route('home')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        $post->load('comments.user');
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        if (!Gate::allows('update-post', $post)) {
            abort(403);
        }

        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        if (!Gate::allows('update-post', $post)) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $post->update($validated);

        return redirect()->route('home')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if (!Gate::allows('delete-post', $post)) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully.');
    }
}
