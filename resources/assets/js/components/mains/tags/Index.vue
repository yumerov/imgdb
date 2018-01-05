<template>
      <section class="section">
        <div class="container">
            <h1>@TODO: top used tags, least used tags, recently created tags,</h1>
            <tag v-for="tag in tags" :tag="tag"></tag>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            tags: [],
        }
    },
    created() {
        window.loading();
        let vm = this;
        axios.get("/api/tags")
            .then((response) => {
                vm.tags = response.data.data;
                window.loaded();
            })
            .catch((error) => {
                window.flash(error.response.data.message, "error");
                window.loaded();
            });
    }
}
</script>