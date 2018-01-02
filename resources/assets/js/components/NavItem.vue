<template>
    <router-link class="navbar-item" :to="link">{{ label }}</router-link>
</template>

<script>
    export default {
        props: ['link', 'label']
    }
</script>
