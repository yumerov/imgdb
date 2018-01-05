<template>
    <div class="hero-body">
        <div class="container">
            <section class="section">
              <div class="container">
                <div class="columns">
                  <h1 class="title column">Recent images</h1>
                </div>
                <div class="columns">
                    <image-thumb v-for="image in images" :image="image"></image-thumb>
                </div>
              </div>
            </section>

            <section class="section">
              <div class="container">
                <h1 class="title">Recent tags</h1>
                <tag v-for="tag in tags" :tag="tag"></tag>
              </div>
            </section>
        </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            images: [],
            tags: [],
        }
    },
    created() {
        let self = this;
        window.loading();
        axios.get("/api/images")
        .then((response) => {
            self.images = response.data.data;
        })
        .then(() => {
            axios.get("/api/tags")
            .then((response) => {
                self.tags = response.data.data;
            });
            window.loaded();
        });
    }
}
</script>
