@extends('layout')

@section("main")
  <section class="section">
    <div class="container">
      @include("shared.success")

      <form action="{{ route("images.store") }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="field">
          <label class="label">Title</label>
          <div class="control">
            <input class="input {{ $errors->has('title') ? 'is-danger': '' }}" name="title" type="text" placeholder="Doggo" value="{{ old("title") }}">
            @include("shared.field-error", ["field" => "title"])
          </div>
        </div>

        <div class="file">
          <label class="file-label">
            <input class="file-input" type="file" name="file">
            <span class="file-cta">
              <span class="file-icon"><i class="fa fa-upload"></i></span>
              <span class="file-label">Choose a file…</span>
            </span>
          </label>
        </div>
        @include("shared.field-error", ["field" => "file"])

        <div class="field">
          <div class="control">
            <input type="submit" value="Create">
          </div>
        </div>
      </form>
    </div>
  </section>
@endsection