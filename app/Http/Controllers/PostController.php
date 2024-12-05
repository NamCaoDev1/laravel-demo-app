<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show']]);
        $this->authorizeResource(Post::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::with('category:id,name')->with('user:id,name,username')->with("tags", function ($query) {
            return $query->orderByDesc("created_at");
        })->latest()->paginate(2);
        $postCount = Post::count();
        return view("post.list", ["posts" => $posts, "postCount" => $postCount]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        //
        $post = new Post();
        $post->fill($request->all());
        $post->user_id = Auth::user()->id;
        $post->save();
        return redirect("/posts/create")->with("success", true);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        $post->load("category:id,name")->load("tags:id,name")->load("comments");
        return view("post.detail", ["post" => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
        $post->load("category:id,name")->load("tags:id,name");
        return view("post.edit", ["post" => $post]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePostRequest $request, Post $post)
    {
        //
        $post->fill($request->all())->update();
        return redirect()->action([PostController::class, 'show'], ["post" => $post->id])->with("success", true);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
        $post->delete();
        return redirect()->action([PostController::class, 'index'])->with("delete_status", true);
    }

    /**
     * Add a comment to post.
     */
    public function addComment(CreateCommentRequest $request, Post $post)
    {
        //
        $post->comments()->create(["content" => $request->comment]);
        return redirect()->action([PostController::class, 'show'], ["post" => $post->id])->with("add_comment_status", true);
    }
}
