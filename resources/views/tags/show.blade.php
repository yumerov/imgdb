@extends('layout')

@section("main")
  <section class="section">
    <div class="container">
      <div class="columns">
        <div class="column is-one-quarter">
          <h1>{{ $tag->name }} [<a href="{{ route("tags.edit", $tag->slug) }}">edit</a>]</h1>
          <form action="{{ route("tags.destroy", $tag->slug) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" value="Delete">
          </form>


        </div>
        <div class="column is-three-quarters">
            <div class="columns is-multiline">
            @foreach ($tag->images as $image)
            <a href="#" class="column is-one-quarter">
              <figure class="image">
                <img src="{{ asset("/img/" . $image->file) }}" class="image">
                <figcaption>{{ $image->title }}</figcaption>
              </figure>
            </a>
            @endforeach
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection