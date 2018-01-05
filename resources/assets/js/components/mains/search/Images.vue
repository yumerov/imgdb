<template>
    <section class="section">
        <div class="container">
            <div class="field has-addons">
                <div class="control">
                    <input class="input" type="text"
                        @keyup.enter="submit"
                        v-model="search.term"
                        placeholder="Find tags">
                </div>
                <div class="control">
                    <button class="button is-info" @click="submit">Search</button>
                </div>
            </div>

            <div class="columns">
                <image-thumb v-for="image in results" :image="image"></image-thumb>
            </div>
            <pagination :pagedata="meta" @page-clicked="openPage"></pagination>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            search: {
                term: ""
            },
            meta: {},
            results: [],
        }
    },
    methods: {
        openPage(page = 1) {
            window.loading();
            let vm = this;
            let url = "/api/images";
            let data = {
                params: {
                    term: vm.search.term,
                    page: page,
                }
            }
            axios.get(url, data).then(this.handleResponse);
        },
        handleResponse(response) {
            let d = response.data;
            this.results = d.data;
            this.meta = d.meta;
            window.loaded();
        },
        submit() {
            window.loading();
            let vm = this;
            vm.results = [];
            axios.get("/api/search/images", { params: vm.search })
                .then((response) => {
                    vm.results = response.data.data;
                    window.loaded();
                })
                .catch((error) => {
                    let data = error.response.data;
                    window.flash(data.message, "error");
                    window.loaded();
                });
        }
    }
}
</script>