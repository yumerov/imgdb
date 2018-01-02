<template>
    <a class="tag is-light" :href="tag.self" v-text="tag.name"></a>
</template>

<script>
export default {
    props: ['tag']
}
</script>
