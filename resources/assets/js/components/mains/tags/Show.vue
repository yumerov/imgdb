<template>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-one-quarter">
                <h1>{{ tag.name }} [<router-link :to="links.edit">edit</router-link>]</h1>
                <button class="button" @click="destroy">Delete</button>

                </div>
                <div class="column is-three-quarters">
                <div class="columns is-multiline">
                    <image-thumb v-if="tag.images" v-for="image in tag.images" :image="image"></image-thumb>
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
            window.loading();
            let vm = this;
            let url = "/api/tags/" + vm.$route.params.slug + "?with_images=true";
            axios.get(url)
                .then((response) => {
                    vm.tag = response.data.data;
                    vm.links = {
                        edit: "/tags/" + vm.tag.slug + "/edit",
                        destroy: "/api/tags/" + vm.tag.slug,
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
                        window.location.hash = "#/tags/";
                        window.location.reload();
                    }, 2000);
                });
        },
        methods: {
            destroy() {
                window.loading();
                let vm = this;
                let data = new FormData();
                data.append("_method", "delete");

                axios.post(vm.links.destroy, data)
                    .then((response) => {
                        window.flash("The tag is deleted.", "success");
                        window.loaded();

                        setTimeout(function() {
                            window.location.hash = "#/tags/";
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
                            window.location.hash = "#/tags/";
                            window.location.reload();
                        }, 2000);
                    });
            }

        }
    }
</script>