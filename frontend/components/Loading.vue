<script>
/**
 * Loader component
 */
export default {
    data: () => ({
        loading: false
    }),
    methods: {
        start() {
            this.loading = true;
        },
        finish() {
            this.loading = false;
        }
    }
};
</script>

<template>
<!-- Loader -->
<div id="preloader" v-if="loading">
    <div id="status">
        <div class="spinner">
            <i class="uil-shutter-alt spin-icon"></i>
        </div>
    </div>
</div>
</template>
