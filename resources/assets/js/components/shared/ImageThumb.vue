<template>
    <router-link :to="/images/ + image.slug" class="column is-one-quarter">
        <figure class="">
            <img :src="image.file" class="image">
            <figcaption v-text="image.title"></figcaption>
        </figure>
    </router-link>
</template>

<script>
export default {
    props: ['image']
}
</script>
