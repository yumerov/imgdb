@extends('layout')

@section("main")
  <section class="section">
    <div class="container">
      <div class="columns">
        @foreach ($images as $image)
          @include("shared.image-thumb", ["image" => $image])
        @endforeach
      </div>
    </div>
  </section>
@endsection