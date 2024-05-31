<script setup>
defineProps(['message']);
</script>

<template>
    <div v-show="message" class="text-sm text-danger">
       {{ message }} &emsp;
    </div>
</template>
