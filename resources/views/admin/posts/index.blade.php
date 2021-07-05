@extends('layouts.app')
@section('content')
  <section class="container">
    <h1>I miei post</h1>
    <div>
      @if (session('deleted'))
        <div class="alert alert-success">
          <strong>{{session('deleted')}}</strong>
          è stato cancellato correttaemnte
        </div>
      @endif
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Category</th>
          <th scope="col" colspan="3">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($posts as $post)
          <tr>
            <th scope="row">{{$post->id}}</th>
            <td>{{$post->title}}</td>
            <td>
              @if ($post->category)
                {{$post->category->name}}
              @else
                -
              @endif
              
            </td>
            <td>
              <a class="btn btn-primary" href="{{route('admin.posts.show',$post)}}">SHOW</a>
            </td>
            <td>
              <a class="btn btn-info" href="{{route('admin.posts.edit',$post)}}">EDIT</a>
            </td>
            <td>
              <form action="{{route('admin.posts.destroy',$post)}}" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">DELETE</button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-4">
      @foreach ($categories as $category)
        <h3>{{$category->name}}</h3>
        <ul>

          @forelse ($category->posts as $post_category)
            <li>
              <a href="{{route('admin.posts.show',$post_category)}}">{{$post_category->title}}</a>
            </li>
          @empty
            <li>Nessun post presente</li>
          @endforelse

        </ul>
      @endforeach
    </div>
  </section>
@endsection