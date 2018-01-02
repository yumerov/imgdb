<template>
    <div class="hero-body">
        <div class="container">
            <section class="section">
              <div class="container">
                <div class="columns">
                  <h1 class="title column">Recent images</h1>
                </div>
                <div class="columns">
                  @foreach ($images as $image)
                    @include("shared.image-thumb", ["image" => $image])
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
        </div>
  </div>
</template>

<script>
export default {
    props: []
}
</script>
