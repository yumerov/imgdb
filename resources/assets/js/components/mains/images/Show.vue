<template>
    <div class="columns">
      <div class="column is-three-quarters">
        <figure>
          <img :src="image.file" class="image">
        </figure>
      </div>
      <div class="column is-one-quarter">
        <h1 class="title">
          {{ image.title }} <router-link :to="links.edit"
            class="button is-small is-dark"><i class="fa fa-edit"></i></router-link>
            <button class="button is-small is-danger" form="image-delete"
                @click="destroy">
                <i class="fa fa-remove"></i></button>
        </h1>
        <tags :tags="image.tags"></tags>
        <div class="columns">
            <image-thumb v-for="image in image.related_images" :image="image"></image-thumb>
        </div>
      </div>
    </div>
</template>

<script>
import { Show as store} from "../../../stores/Images.js";
import { redirect } from "../../../mixins.js";
export default {
    store,
    mixins: [redirect],
    computed: {
        image() { return this.$store.state.image },
        links() { return this.$store.state.links },
    },
    watch: {
        '$route' (to, from) {
            this.$store.dispatch("show", to.params.slug);
        }
    },
    created() {
        let vm = this;
        vm.$store.dispatch("show", vm.$route.params.slug)
            .catch((error) => {
                vm.redirect("#/images");
            });
    },
    methods: {
        destroy() {
            let vm = this;
            vm.$store.dispatch("destroy", vm.$route.params.slug)
                .then(() => {
                    vm.redirect("#/images");
                });
        }
    }
}
</script>