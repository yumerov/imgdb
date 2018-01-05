<template>
    <router-link class="tag is-light" :to="link" v-text="tag.name"></router-link>
</template>

<script>
export default {
    props: ['tag'],
    data() {
        let vm = this;
        return {
            link: "/tags/" + vm.tag.slug,
        }
    }
}
</script>
