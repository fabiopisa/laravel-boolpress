@extends('layouts.app')
@section('content')
  <section class="container">
    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>
    <div>
      <a class="btn btn-info" href="{{route('admin.posts.edit',$post)}}">EDIT</a>
      
    </div>
    <div class="mt-5">
      <a href="{{route('admin.posts.index')}}"><<-Back</a>
    </div>
    
  </section>
@endsection