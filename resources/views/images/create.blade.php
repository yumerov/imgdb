@extends('layout')

@section("title", "Create an image")

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

        <div class="field">
          <div class="control">
              <select name="tags[]" multiple data-placeholder="Select tags">
                @foreach ($tags as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
              </select>
          </div>
        </div>

        <div class="file">
          <label class="file-label">
            <input class="file-input" type="file" name="file">
            <span class="file-cta">
              <span class="file-icon"><i class="fa fa-upload"></i></span>
              <span class="file-label">Choose a file…</span>
            </span>
            <span class="file-name"></span>
          </label>
          <figure class="image is-128x128">
            <img src="" id="preview">
          </figure>
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