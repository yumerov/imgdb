<template>
    <div class="hero-body">
        <div class="container">
            <section class="section">
              <div class="container">
                <div class="columns">
                  <h1 class="title column">Recent images</h1>
                </div>
                <div class="columns is-multiline">
                    <image-thumb v-for="image in images" :image="image"></image-thumb>
                </div>
              </div>
            </section>

            <section class="section">
                <div class="container">
                    <h1 class="title">Recent tags</h1>
                    <tags :tags="tags"></tags>
                </div>
            </section>
        </div>
  </div>
</template>

<script>
import { Home as store} from "../../stores/Home.js";
export default {
    computed: {
        images() { return this.$store.state.images; },
        tags() { return this.$store.state.tags; },
    },
    store,
    created() {
        let vm = this;
        const d = vm.$store.dispatch;
        d("GET_IMAGES");
        d("get_tags");
    }
}
</script>
