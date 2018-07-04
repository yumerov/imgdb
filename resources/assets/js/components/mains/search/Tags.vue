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

            <tag v-for="tag in results" :tag="tag"></tag>
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
            results: [],
        }
    },
    methods: {
        submit() {
            let vm = this;
            vm.results = [];
            axios.get("/api/search/tags", { params: vm.search })
                .then((response) => {
                    vm.results = response.data.data;
                });
        }
    }
}
</script>