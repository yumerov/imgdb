<template>
    <div class="columns">
        <my-flash></my-flash>
      <div class="column is-three-quarters">
        <figure>
          <img :src="image.file" class="image">
        </figure>
      </div>
      <div class="column is-one-quarter">
        <h1 class="title">
          {{ image.title }} <router-link :to="links.edit"
            class="button is-smallis-dark"><i class="fa fa-edit"></i></router-link>
          <!-- <button type="submit" class="button is-small is-danger" form="image-delete"><i class="fa fa-remove"></i></button> -->
        </h1>
        <!-- <form id="image-delete" action="{{ route("images.destroy", $image) }}" method="post">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
        </form> -->
        <tag v-for="tag in image.tags" :tag="tag"></tag>
        <p>at TODO: related images based on common tags</p>
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
    created() {
        let vm = this;
        let url = "/api/images/" + this.$route.params.slug;
        axios.get(url)
            .then((response) => {
                vm.image = response.data.data;
                vm.links = {
                    edit: "/images/" + vm.image.slug + "/edit",
                    destroy: "/api/images/" + vm.image.slug,
                }
            }).catch((error) => {
                if (error.response.status == 404) {
                    window.flash("Not found", "error");
                } else {
                    window.flash(data.message, "error");
                }
                setTimeout(function() {
                    window.location.hash = "#/images/";
                    window.location.reload();
                }, 2000);
            });
    }
}
</script>