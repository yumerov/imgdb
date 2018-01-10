<template>
    <div class="hero-head">
        <nav class="navbar">
            <div class="container">
                <div class="navbar-brand">
                    <router-link class="navbar-item" to="/">
                        <h1>{{ logo }}</h1>
                    </router-link>
                    <span class="navbar-burger burger" data-target="navbarMenu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </div>
            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-end">
                    <nav-item link="/images" label="Images"></nav-item>
                    <nav-item link="/images/create" label="Create an image"></nav-item>
                    <nav-item link="/tags" label="Tags"></nav-item>
                    <nav-item link="/tags/create" label="Create a tag"></nav-item>
                    <nav-item link="/search/tags" label="Search tags"></nav-item>
                    <nav-item link="/search/images" label="Search images"></nav-item>
                </div>
            </div>
            </div>
        </nav>
    </div>
</template>

<script>
export default {
    computed: {
        logo() {
            return window.data.app.name;
        }
    }
}
</script>
