<template>
    <section class="hero is-fullheight is-default is-bold">
        <app-header></app-header>
        <my-flash></my-flash>
        <div class="hero-body">
            <div class="container">
                <router-view></router-view>
            </div>
        </div>
        <app-footer></app-footer>
    </section>
</template>

<script>
export default {
    props: []
}
</script>
