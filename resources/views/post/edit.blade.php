@extends('layouts.app');

@section("title", $post->title);

@section('content')
<div class="container">
<h1 class="mt-3">Edit Post</h1>
@foreach ($errors->all() as $message)
<div class="alert alert-danger" role="alert">
  {{$message}}
</div>
@endforeach
@if (session('success'))
<div class="alert alert-success" role="alert">
  Chinh sua bai viet thanh cong
</div>
@endif
<form action={{ route('posts.update', ["post" => $post->id]) }} method="post">
  @method('PUT')
  @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Title</label>
    <input class="form-control" name="title" value="{{$post['title']}}">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Content</label>
    <textarea class="form-control"  id="floatingTextarea2" style="height: 300px" name="content">{{$post['content']}}</textarea>
  </div>
  <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Author</label>
      <input class="form-control" name="author" value="{{$post['author']}}">
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
@endsection
