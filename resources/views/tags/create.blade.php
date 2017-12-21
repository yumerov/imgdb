@extends('layout')

@section("main")
  <section class="section">
    <div class="container">
      <form action="{{ route("tags.store") }}" method="POST">
        {{ csrf_field() }}
        <div class="field">
          <label class="label">Name</label>
          <div class="control">
            <input class="input {{ $errors->has('name') ? 'is-danger': '' }}" name="name" type="text" placeholder="Funny">
            @if ($errors->has("name"))
            <p class="help is-danger">{{ $errors->first("name") }}</p>
            @endif
          </div>
        </div>
        <div class="field">
          <div class="control">
            <input type="submit" value="Create">
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection