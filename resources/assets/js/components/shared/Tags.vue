<template>
    <div class="tags">
        <tag v-for="tag in tags" :tag="tag"></tag>
    </div>
</template>

<script>
export default {
    props: ['tags'],
}
</script>
