<template>
    <div class="columns">
      <div class="column is-three-quarters">
        <figure>
          <img :src="image.file" class="image">
        </figure>
      </div>
      <div class="column is-one-quarter">
        <h1 class="title">
          {{ image.title }} <!-- <a href="{{ route("images.edit", $image) }}" class="button is-small is-dark"><i class="fa fa-edit"></i></a> -->
          <!-- <button type="submit" class="button is-small is-danger" form="image-delete"><i class="fa fa-remove"></i></button> -->
        </h1>
        <!-- <form id="image-delete" action="{{ route("images.destroy", $image) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        </form> -->
        @foreach ($image->tags as $tag)
          @include("shared.tag", ["tag" => $tag])
        @endforeach
        <p>at TODO: related images based on common tags</p>
      </div>
    </div>
</template>

<script>
export default {
    prop: ["image"]
}
</script>