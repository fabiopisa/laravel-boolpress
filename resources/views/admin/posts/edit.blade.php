@extends('layouts.app')
@section('content')
  <section class="container">
    <h1>Modifica:<a href="{{route('admin.posts.show',$post)}}">{{$post->title}}</a> </h1>
    <div>
      <form action="{{route('admin.posts.update',$post)}}" method="POST">
        @csrf
        @method('patch')

        <div class="mt-3">
          <label class="label-control" for="title">Title</label>
          <input class="form-control" type="text" name="title" id="title" value="{{$post->title}}">
        </div>
        <div class="mt-3">
          <label class="label-control" for="content">Content</label>
          <textarea class="form-control" type="text" name="content" id="content" rows="5">{{$post->content}}</textarea>
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">SUBMIT</button>
        </div>
      </form>
    </div>
  </section>
@endsection