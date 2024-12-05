@extends('layouts.app');

@section("title", $post->title);

@section('content')
<div class="container">
@foreach ($errors->all() as $message)
<div class="alert alert-danger" role="alert">
  {{$message}}
</div>
@endforeach

<div class="d-flex justify-content-between align-items-center my-3">
  <h1>{{$post->title}}</h1>
  <a class="btn btn-primary" href={{route("posts.edit", ["post" => $post->id])}} role="button">Edit post</a>
</div>

<div class="mb-2">
   {{$post->content}}
</div>

<div class="mb-2">
  Category: @if (isset($post->category))
   {{$post->category->name}}
   @else
   No category
  @endif
</div>

<div class="mb-2">
  Author: @if (isset($post->user))
   {{$post->user->name}}
   @else
   No author
  @endif
</div>

<div class="mb-2">
  Tags: @foreach ( $post->tags as $tags )
     {{$tags->name}}
  @endforeach
</div>

<div class="mb-2">
  Comments:
    <ul>
        @foreach ( $post->comments as $comment )
        <li>{{$comment->content}}</li>
        @endforeach
    </ul>
</div>

@if (session('add_comment_status'))
  <div class="alert alert-success" role="alert">
    Them binh luan thanh cong
  </div>
  @endif

<form action={{route("posts.comment.create", ["post" => $post->id])}} method="post">
  @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Your Comment:</label>
    <textarea class="form-control" placeholder="Add your comment" id="floatingTextarea2" style="height: 150px" name="comment"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Add comment</button>
</form>

</div>
@endsection
