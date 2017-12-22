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

          <p>at TODO: related images based on common tags</p>
        </div>
      </div>
    </div>
  </section>
@endsection