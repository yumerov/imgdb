@extends('layout')

@section("main")
  <section class="section">
    <div class="container">
      @if (Session::has('success'))
      <article class="message is-success">
        <div class="message-body">{{ Session::get('success') }}</div>
      </article>
      @endif
      <h1>@TODO: top used tags, least used tags, recently created tags,</h1>
      @foreach ($tags as $tag)
        <a class="button is-light" href="{{ route("tags.show", $tag->slug) }}">
          {{ $tag->name }}
        </a>
      @endforeach
    </div>
  </section>
@endsection