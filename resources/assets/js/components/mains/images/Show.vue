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
export default {
    data() {
        return {
            image: {},
            links: {
                edit: "",
                destroy: "",
            }
        };
    },
    watch: {
      '$route' (to, from) {
        let vm = this;
        vm.loadImage();
      }
    },
    created() {
        let vm = this;
        vm.loadImage();
    },
    methods: {
        loadImage() {
            window.loading();
            let vm = this;
            let url = "/api/images/" + vm.$route.params.slug;
            axios.get(url)
                .then((response) => {
                    vm.image = response.data.data;
                    vm.links = {
                        edit: "/images/" + vm.image.slug + "/edit",
                        destroy: "/api/images/" + vm.image.slug,
                    }
                    window.loaded();
                }).catch((error) => {
                    if (error.response.status == 404) {
                        window.flash("Not found", "error");
                    } else {
                        window.flash(error.response.data.message, "error");
                    }
                    window.loaded();

                    setTimeout(function() {
                        window.location.hash = "#/images/";
                        window.location.reload();
                    }, 2000);
                });

        },
        destroy() {
            window.loading();
            let vm = this;
            let data = new FormData();
            data.append("_method", "delete");

            axios.post(vm.links.destroy, data)
                .then((response) => {
                    window.flash("The imaeg is deleted.", "success");
                    window.loaded();

                    setTimeout(function() {
                        window.location.hash = "#/images/";
                        window.location.reload();
                    }, 2000);
                })
                .catch((error) => {
                    if (error.response.status == 404) {
                        window.flash("Not found", "error");
                    } else {
                        window.flash(data.message, "error");
                    }
                    window.loaded();

                    setTimeout(function() {
                        window.location.hash = "#/images/";
                        window.location.reload();
                    }, 2000);
                });
        }
    }
}
</script>