@extends('layout')

@section("main")
  <section class="section">
    <div class="container">
      <h1>@TODO: top used tags, least used tags, recently created tags,</h1>
      @foreach ($tags as $tag)
        <a class="button is-light" href="{{ route("tags.show", $tag->slug) }}">
          {{ $tag->name }}
        </a>
      @endforeach
    </div>
  </section>
@endsection