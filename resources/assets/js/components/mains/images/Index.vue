<template>
    <section class="section">
        <div class="container">
            <!-- @include("shared.success") -->
            <div class="columns">
                <image-thumb v-for="image in images" :image="image"></image-thumb>
            </div>
            <pagination :pagedata="meta" @page-clicked="openPage"></pagination>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            images: [],
            links: {},
            meta: {},
        }
    },
    methods: {
        openPage(page = 1) {
            let url = "/api/images?page=" + page;
            axios.get(url).then(this.handleResponse);
        },
        handleResponse(response) {
            let d = response.data;
            this.images = d.data;
            this.links = d.links;
            this.meta = d.meta;
            this.$router.push({ params: { page: d.meta.current_page } });
        },


    },
    mounted() {
        this.openPage(this.$route.query.page);
    }
}
</script>
