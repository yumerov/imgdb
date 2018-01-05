<template>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-one-quarter">
                <h1>{{ tag.name }} [<router-link :to="links.edit">edit</router-link>]</h1>
                <input type="submit" value="Delete">

                </div>
                <div class="column is-three-quarters">
                <div class="columns is-multiline">
                    <image-thumb v-for="image in tag.images" :image="image"></image-thumb>
                </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                tag: {},
                links: {}
            }
        },
        created() {
            let vm = this;
            let url = "/api/tags/" + vm.$route.params.slug + "?with_images=true";
            axios.get(url)
                .then((response) => {
                    vm.tag = response.data.data;
                    vm.links = {
                        edit: "/tags/" + vm.tag.slug + "/edit",
                        destroy: "/api/tags/" + vm.tag.slug,
                    }
                }).catch((error) => {
                    if (error.response.status == 404) {
                        window.flash("Not found", "error");
                    } else {
                        window.flash(error.response.data.message, "error");
                    }

                    setTimeout(function() {
                        window.location.hash = "#/tags/";
                        window.location.reload();
                    }, 2000);
                });
        },
    }
</script>