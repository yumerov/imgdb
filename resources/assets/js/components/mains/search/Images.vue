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
                            :options="tags.positive"
                            :on-change="changePositive"></v-select>
                    </div>
                </div>
                <div class="column field">
                    <div class="label">Excluding tags:</div>
                    <div class="control">
                        <v-select multiple label="name" value="id"
                            v-model="search.negative_tags"
                            :options="tags.negative"
                            :on-change="changeNegative"></v-select>
                    </div>
                </div>
                <div class="column field">
                    <div class="label"></div>
                    <div class="control has-text-centered">
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
            tags: {
                all: [],
                positive: [],
                negative: [],
            },
            meta: {},
            results: [],
        }
    },
    created() {
        let vm = this;
        axios.get("/api/tags")
            .then((response) => {
                let d = response.data.data;
                vm.tags = {
                    all: d,
                    positive: d,
                    negative: d,
                };
            });
    },
    methods: {
        changeNegative(value) {
            if (value.length == 0) {
                return;
            }
            let vm = this;
            let ids = value.map((tag) => tag.id);
            let not_excluded = (tag) => !ids.includes(tag.id);
            if (vm.tags.positive.length == vm.tags.all.filter(not_excluded).length) {
                return;
            }
            vm.tags.positive = vm.tags.all.filter(not_excluded);
            if (vm.search.positive_tags.length == vm.search.positive_tags.filter(not_excluded)) {
                return;
            }
            vm.search.positive_tags = vm.search.positive_tags.filter(not_excluded);
        },
        changePositive(value) {
            if (value.length == 0) {
                return;
            }
            let vm = this;
            let ids = value.map((tag) => tag.id);
            let not_excluded = (tag) => !ids.includes(tag.id);
            if (vm.tags.negative.length == vm.tags.all.filter(not_excluded).length) {
                return;
            }
            vm.tags.negative = vm.tags.all.filter(not_excluded);
            if (vm.search.negative_tags.length == vm.search.negative_tags.filter(not_excluded)) {
                return;
            }
            vm.search.negative_tags = vm.search.negative_tags.filter(not_excluded);
        },
        openPage(page = 1) {
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
        },
        transformSearchData() {
            let vm = this;
            let data = JSON.parse(JSON.stringify(vm.search)); // deep clone
            data.positive_tags = data.positive_tags.map((tag) => tag.id)
            data.negative_tags = data.negative_tags.map((tag) => tag.id)
            return data;
        },
        submit() {
            let vm = this;
            vm.results = [];
            axios.get("/api/search/images", { params: vm.transformSearchData() })
                .then((response) => {
                    let d = response.data
                    vm.results = d.data;
                    vm.meta = d.meta
                });
        }
    }
}
</script>