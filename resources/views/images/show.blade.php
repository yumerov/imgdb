@extends('layout')

@section("main")
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-three-quarters">
          <figure>
            <img src="{{ asset("/img/" . $image->file) }}" class="image">
          </figure>
        </div>
        <div class="column is-one-quarter">
          <h1 class="title">{{ $image->title }}</h1>
          @foreach ($image->tags as $tag)
            @include("shared.tag", ["tag" => $tag])
          @endforeach

          <a href="{{ route("images.edit", $image) }}" class="button is-dark">Edit</a>
          <form action="{{ route("images.destroy", $image) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="Delete">
          </form>


          <p>at TODO: related images based on common tags</p>
        </div>
      </div>
    </div>
  </section>
@endsection