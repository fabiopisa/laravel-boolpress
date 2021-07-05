@extends('layouts.app')
@section('content')
  <section class="container">
    <h1>{{$post->title}}</h1>
    <p>{{$post->content}}</p>
    <h3>
      @if ($post->category)
        Categoria: {{$post->category->name}}
      @else
        Non esiste questa categoria!
      @endif
    </h3>
    <div>
      <a class="btn btn-info" href="{{route('admin.posts.edit',$post)}}">EDIT</a>
      
    </div>
    <div class="mt-5">
      <a href="{{route('admin.posts.index')}}"><<-Back</a>
    </div>
    
  </section>
@endsection