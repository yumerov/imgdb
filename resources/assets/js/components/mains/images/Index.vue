<template>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <image-thumb v-for="image in images" :image="image"></image-thumb>
            </div>
            <pagination :pagedata="meta" @page-clicked="openPage"></pagination>
        </div>
    </section>
</template>

<script>
import { Index as store} from "../../../stores/Images.js";
export default {
    computed: {
        images() { return this.$store.state.images },
        meta() { return this.$store.state.meta }
    },
    store,
    methods: {
        /**
         * @param page
         */
        openPage(page = 1) {
            this.$store.dispatch("load", page);
        },
    },
    created() {
        this.openPage(this.$route.query.page);
    }
}
</script>
