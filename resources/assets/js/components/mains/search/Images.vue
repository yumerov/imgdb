<template>
    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="field column">
                    <div class="label">Search term:</div>
                    <div class="control">
                        <input class="input" type="text"
                            @keyup.enter="submit"
                            v-model="search.term"
                            placeholder="Find images">
                    </div>
                </div>
                <div class="column field">
                    <div class="label">Including tags:</div>
                    <div class="control">
                        <v-select multiple label="name" value="id"
                            v-model="search.positive_tags"
                            :options="tags"></v-select>
                    </div>
                </div>
                <div class="column field">
                    <div class="label">Excluding tags:</div>
                    <div class="control">
                        <v-select multiple label="name" value="id"
                            v-model="search.negative_tags"
                            :options="tags"></v-select>
                    </div>
                </div>
                <div class="column field">
                    <div class="label"></div>
                    <div class="control">
                        <button class="button is-large" @click="submit">
                            Search
                        </button>
                    </div>
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
                term: "",
                positive_tags: [],
                negative_tags: [],

            },
            tags: [],
            meta: {},
            results: [],
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
                let data = error.response.data;
                window.flash(data.message, "error");
                window.loaded();
            });
    },
    methods: {
        openPage(page = 1) {
            window.loading();
            let vm = this;
            let url = "/api/search/images";
            let data = {};
            data.params = vm.transformSearchData();
            data.params.page = page;
            axios.get(url, data).then(this.handleResponse);
        },
        handleResponse(response) {
            let d = response.data;
            this.results = d.data;
            this.meta = d.meta;
            window.loaded();
        },
        transformSearchData() {
            let vm = this;
            let data = JSON.parse(JSON.stringify(vm.search)); // deep clone
            data.positive_tags = data.positive_tags.map((tag) => tag.id)
            data.negative_tags = data.negative_tags.map((tag) => tag.id)
            return data;
        },
        submit() {
            window.loading();
            let vm = this;
            vm.results = [];
            axios.get("/api/search/images", { params: vm.transformSearchData() })
                .then((response) => {
                    let d = response.data
                    vm.results = d.data;
                    vm.meta = d.meta
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