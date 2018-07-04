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
        let vm = this;
        axios.get("/api/tags").then((res) => {
            vm.tags.all = res.data.data;
        });

        axios.get("/api/tags", { params: { tab: "first"} }).then((res) => {
            vm.tags.oldest = res.data.data;
        });

        axios.get("/api/tags", { params: { tab: "last"} }).then((res) => {
            vm.tags.newest = res.data.data;
        });

        axios.get("/api/tags", { params: { tab: "most_used"} }).then((res) => {
            vm.tags.most_used = res.data.data;
        });

        axios.get("/api/tags", { params: { tab: "least_used"} }).then((res) => {
            vm.tags.least_used = res.data.data;
        });
    }
}
</script>