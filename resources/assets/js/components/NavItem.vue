<template>
    <a class="navbar-item" :href="link">{{ label }}</a>
</template>

<script>
    export default {
        props: ['link', 'label']
    }
</script>
