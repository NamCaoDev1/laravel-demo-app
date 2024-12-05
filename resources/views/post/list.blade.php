@extends("layouts.app")

@section("title", "Post lists")

@section('content')
<div class="container">
<div class="d-flex justify-content-between align-items-center my-3">
  <h1>Danh sach bai viet</h1>
  <a class="btn btn-primary" href={{route("posts.create")}} role="button">Create new post</a>
</div>
@if (session('delete_status'))
  <div class="alert alert-success" role="alert">
    Xoa bai viet thanh cong
  </div>
  @endif
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Content</th>
        <th scope="col">Author</th>
        <th scope="col">Category</th>
        <th scope="col">Tags</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @if (count($posts) > 0)
            @foreach ($posts as $post)
            <tr>
                <th scope="row">{{$post->id}}</th>
                <td>{{$post->title}}</td>
                <td>{{$post->content}}</td>
                @if ($post->user && $post->user->name)
                  <td>{{$post->user->name}}</td>
                  @else
                  <td>No author</td>
                @endif
                @if ($post->category && $post->category->name)
                  <td>{{$post->category->name}}</td>
                  @else
                  <td>No category</td>
                @endif
                <td>
                   @foreach ($post->tags as $tag)
                     {{$tag->name}} ,
                   @endforeach
                </td>
                <td>
                    <a href={{route("posts.show", ["post" => $post->id])}} class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Detail</a> |
                    <form action={{ route('posts.destroy', ["post" => $post->id]) }} method="POST">
                        @csrf
                        @method("DELETE")
                       <button type="submit" class="d-inline link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        @else
            <tr>
                Not found post....
            </tr>
        @endif

    </tbody>
  </table>

  <div>
    <ul class="pagination">
      @if (request()->get('page') > 1)
      <li class="page-item"><a class="page-link" href={{route("posts.index", ["page" => request()->get('page') - 1])}}>Previous</a></li>
      @else
      <li class="page-item"><a class="page-link d-none">Previous</a></li>
      @endif
        @for ($i = 0; $i < ceil($postCount / 2); $i++)
        <li class="page-item"><a class="page-link" href={{route("posts.index", ["page" => $i + 1])}}>{{$i + 1}}</a></li>
        @endfor
      @if (request()->get('page') < $postCount / 2)
      <li class="page-item"><a class="page-link" href={{route("posts.index", ["page" => request()->get('page') + 1])}}>Next</a></li>
      @else
      <li class="page-item"><a class="page-link d-none">Next</a></li>
      @endif
    </ul>
  </div>
</div>
@endsection
