@extends('layouts.app')
@section('content')
  <section class="container">
    <h1>Modifica:<a href="{{route('admin.posts.show',$post)}}">{{$post->title}}</a> </h1>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
          @endforeach
        </ul>
      </div>
    @endif
    <div>
      <form action="{{route('admin.posts.update',$post)}}" method="POST">
        @csrf
        @method('patch')

        <div class="mt-3">
          <label class="label-control" for="title">Title</label>
          <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" id="title" value="{{old('title',$post->title)}}">
          @error('title')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="mt-3">
          <label class="label-control" for="content">Content</label>
          <textarea class="form-control  @error('content') is-invalid @enderror" type="text" name="content" id="content" rows="5">{{old('content',$post->content)}}</textarea>
          @error('content')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="mt-3">
          <label class="label-control" for="category_id">Category</label>
          <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
            <option value="">Selezionare una categoria</option>
            @foreach ($categories as $category)
              <option @if(old('category_id', $post->category_id) == $category->id) selected @endif value="{{$category->id}}">
                {{$category->name}}
              </option>
            @endforeach
          </select>

          @error('category_id')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="mt-3">
          <h3>Tags</h3>
          @foreach ($tags as $tag )
            <span class="d-inline-block mr-3">
              <input type="checkbox" 
              id="tag{{$loop->iteration}}" 
              name="tags[]" 
              value="{{$tag->id}}"
              {{-- nella condizione if gli dico se nell'array old è presente l'id di $tag e ci sono errori mi stampi checked perchè anche se sbaglio altri parametri deve rimanere checked --}}
              @if (in_array($tag->id,old('tags',[])) && $errors->any())
                checked
              {{--nella condizione di else if gli dico che se non ci sono errori e se dentro i tags di post è presente l'id che sto ciclando e lo scrivo così --}}
              @elseif (!$errors->any() && $post->tags->contains($tag->id))
                checked
              @endif
              >
              <label for="tag{{$loop->iteration}}">{{$tag->name}}</label>
            </span>
            
          @endforeach
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">SUBMIT</button>
        </div>
      </form>
    </div>
  </section>
@endsection