@extends('layout')

@section("main")
  <section class="section">
    <div class="container">
      @include("shared.success")
      <h1>@TODO: top used tags, least used tags, recently created tags,</h1>
      @foreach ($tags as $tag)
        @include("shared.tag", ['tag' => $tag])
      @endforeach
    </div>
  </section>
@endsection