<template>
    <div>
        <flash :types="types"></flash>
    </div>
</template>

<script>
import flash from 'vue-flash';

export default {
    data() {
        return {
            types: {
                base: 'notification',
                success: 'is-success',
                error: 'is-danger',
                warning: 'is-warning',
                info: 'is-info',
            }
        }
    },
    components: {
        flash
    }
}
</script>