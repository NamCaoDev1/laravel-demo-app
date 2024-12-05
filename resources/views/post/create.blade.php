@extends('layouts.app')

@section('title', 'Create new post')
@section('content')
<div class="container">
  <h1 class="mt-3">Create New Post</h1>
  @foreach ($errors->all() as $message)
  <div class="alert alert-danger" role="alert">
    {{$message}}
  </div>
  @endforeach
  @if (session('success'))
  <div class="alert alert-success" role="alert">
    Them bai viet thanh cong
  </div>
  @endif
  <form action={{ route('posts.store') }} method="post">
    @csrf
    <div class="mb-3">
      <label for="exampleInputEmail1" class="form-label">Title</label>
      <input class="form-control" name="title">
    </div>
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label">Content</label>
      <textarea class="form-control" placeholder="Add your content" id="floatingTextarea2" style="height: 300px" name="content"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  </div>
@endsection
