<template>
      <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <div class="column is-half">
                    <h2 class="is-bold title">Most used tags:</h2>
                    <tags :tags="tags.most_used"></tags>
                </div>
                <div class="column is-half">
                    <h2 class="is-bold title">Least used tags:</h2>
                    <tags :tags="tags.least_used"></tags>
                </div>

                <div class="column is-half">
                    <h2 class="is-bold title">Newest tags:</h2>
                    <tags :tags="tags.newest"></tags>
                </div>
                <div class="column is-half">
                    <h2 class="is-bold title">Oldest tags:</h2>
                    <tags :tags="tags.oldest"></tags>
                </div>

                <div class="column">
                    <h2 class="is-bold title">All Tags</h2>
                    <tags :tags="tags.all"></tags>
                </div>
            </div>


        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            tags: {
                all: [],
                newest: [],
                oldest: [],
                most_used: [],
                least_used: [],
            },
        }
    },
    created() {
        window.loading();
        let vm = this;
        axios.get("/api/tags")
            .then((response) => {
                vm.tags.all = response.data.data;
                window.loaded();
            })
            .catch((error) => {
                window.flash(error.response.data.message, "error");
                window.loaded();
            });

        axios.get("/api/tags", { params: { tab: "first"} })
            .then((response) => {
                vm.tags.oldest = response.data.data;
                window.loaded();
            })
            .catch((error) => {
                window.flash(error.response.data.message, "error");
                window.loaded();
            });

        axios.get("/api/tags", { params: { tab: "last"} })
            .then((response) => {
                vm.tags.newest = response.data.data;
                window.loaded();
            })
            .catch((error) => {
                window.flash(error.response.data.message, "error");
                window.loaded();
            });

        axios.get("/api/tags", { params: { tab: "most_used"} })
            .then((response) => {
                vm.tags.most_used = response.data.data;
                window.loaded();
            })
            .catch((error) => {
                window.flash(error.response.data.message, "error");
                window.loaded();
            });

        axios.get("/api/tags", { params: { tab: "least_used"} })
            .then((response) => {
                vm.tags.least_used = response.data.data;
                window.loaded();
            })
            .catch((error) => {
                window.flash(error.response.data.message, "error");
                window.loaded();
            });
    }
}
</script>