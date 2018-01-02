<template>
    <div class="hero-foot">
        <div class="container">
            <div class="tabs is-centered">
                <ul>
                    <li><a>{{ footer }}</a></li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            footer() {
                let d = window.data;
                return d.app.name + " - " + d.year;
            }
        }
    }
</script>
