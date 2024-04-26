<script setup>
import {watch} from 'vue'

const props = defineProps({
    open: {
        type: Boolean,
        default: true,
    }
});

watch(
    () => props.open,
    () => {

        if (window.innerWidth >= 992) {
            if (props.open) {
                document.body.classList.remove('sidebar-enable', 'vertical-collpsed');
            } else {
                document.body.classList.add('sidebar-enable', 'vertical-collpsed');
            }
        } else {
            if (props.open) {
                document.body.classList.remove('sidebar-enable');
            } else {
                document.body.classList.add('sidebar-enable');
            }
        }
    }
);
</script>

<template>
    <button id="vertical-menu-btn" class="btn btn-sm px-3 font-size-24 header-item" type="button">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
</template>

<style scoped>

</style>

