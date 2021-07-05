@extends('layouts.app')
@section('content')
  <section class="container">
    <h1>Nuovo Post</a> </h1>
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
      <form action="{{route('admin.posts.store')}}" method="POST">
        @csrf
        @method('post')

        <div class="mt-3">
          <label class="label-control" for="title">Title</label>
          <input 
          class="form-control @error('title') is-invalid @enderror " type="text" name="title" id="title"
          value="{{old('title')}}"
          >
          @error('title')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="mt-3">
          <label class="label-control" for="content">Content</label>
          <textarea class="form-control @error('content') is-invalid @enderror" type="text" name="content" id="content" rows="5">{{old('content')}}</textarea>
          @error('content')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="mt-3">
          <label class="label-control" for="category_id">Category</label>
          <select class="form-control @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
            <option value="">Selezionare una categoria</option>
            @foreach ($categories as $category)
              <option @if(old('category_id') == $category->id) selected @endif value="{{$category->id}}">
                {{$category->name}}
              </option>
            @endforeach
          </select>

          @error('category_id')
            <div class="text-danger">{{$message}}</div>
          @enderror
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">SUBMIT</button>
          <button type="reset" class="btn btn-secondary">RESET</button>
        </div>
      </form>
    </div>
  </section>
@endsection