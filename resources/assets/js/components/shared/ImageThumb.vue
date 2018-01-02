<template>
    <a :href="image.self" class="column is-one-quarter">
        <figure class="">
            <img :src="image.file" class="image">
            <figcaption v-text="image.title"></figcaption>
        </figure>
    </a>
</template>

<script>
export default {
    props: ['image']
}
</script>
