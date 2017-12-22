@extends('layout')

@section("main")
  <section class="section">
    <div class="container">
      <div class="columns">
        <h1 class="title column">Recent images</h1>
      </div>
      <div class="columns">
        @foreach ($images as $image)
          <figure class="column is-one-quarter">
            <img src="{{ asset("/img/" . $image->file) }}" class="image">
            <figcaption>{{ $image->title }}</figcaption>
          </figure>
        @endforeach
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <h1 class="title">Recent tags</h1>
      @foreach ($tags as $tag)
        @include("shared.tag", ['tag' => $tag])
      @endforeach
    </div>
  </section>
@endsection