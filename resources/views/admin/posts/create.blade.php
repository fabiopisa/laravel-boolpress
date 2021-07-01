@extends('layouts.app')
@section('content')
  <section class="container">
    <h1>Nuovo Post</a> </h1>
    <div>
      <form action="{{route('admin.posts.store')}}" method="POST">
        @csrf
        @method('post')

        <div class="mt-3">
          <label class="label-control" for="title">Title</label>
          <input class="form-control" type="text" name="title" id="title">
        </div>
        <div class="mt-3">
          <label class="label-control" for="content">Content</label>
          <textarea class="form-control" type="text" name="content" id="content" rows="5"></textarea>
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">SUBMIT</button>
          <button type="reset" class="btn btn-secondary">RESET</button>
        </div>
      </form>
    </div>
  </section>
@endsection