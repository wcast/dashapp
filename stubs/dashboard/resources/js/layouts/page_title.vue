<template>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h2 class="mb-0 font-size-18">{{title}}</h2>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    title: String,
});

</script>

<style scoped>
.page-title-right{
    width: 100%;
}
</style>
