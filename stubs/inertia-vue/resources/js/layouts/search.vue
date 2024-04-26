<script setup>
import {ref} from 'vue'
import {useForm} from '@inertiajs/vue3';

const form = useForm();

let search = ref('')

const goSearch = () => {

   // Inertia.get(route('search'), {search: search}, {preserveState: true});
}
</script>
<template>
    <form class="app-search d-none d-lg-block" @keyup.prevent="goSearch">
        <div class="position-relative">
            <input type="text" class="form-control" v-model="search" placeholder="Search...">
            <span class="mdi mdi-magnify"></span>
        </div>
    </form>
</template>
