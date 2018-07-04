<template>
    <section class="hero is-fullheight is-default is-bold">
        <app-header></app-header>
        <my-flash></my-flash>
        <div class="hero-body" v-loading="isLoading">
            <div class="container">
                <router-view></router-view>
            </div>
        </div>
        <app-footer></app-footer>
    </section>
</template>

<script>
export default {
    data() {
        return {
            isLoading: false,
        }
    },

    created() {
        let vm = this;
        window.events.$on('loading', () => { vm.isLoading = true })
        window.events.$on('loaded', () => { vm.isLoading = false })
    }
}
</script>
