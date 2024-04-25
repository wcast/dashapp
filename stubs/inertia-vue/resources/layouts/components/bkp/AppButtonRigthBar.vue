<template>
    <div class="dropdown d-inline-block">
        <button @click="showSideBar" type="button" class="btn header-item noti-icon waves-effect">
            <i class="mdi mdi-tune"></i>
        </button>
    </div>
</template>

<script setup>
import {computed, watch} from 'vue';
import {usePage} from "@inertiajs/vue3";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    }
});

const emit = defineEmits(['rightBar']);

function showSideBar() {
    if (!props.show) {
        $('body').toggleClass('right-bar-enabled');
    }
    $('.rightbar-overlay').on('click', function () {
        $('body').removeClass('right-bar-enabled');
    });
}
</script>

<style scoped>

</style>
