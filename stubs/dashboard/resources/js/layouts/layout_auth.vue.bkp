<script setup>

import Footer from "@/layouts/footer.vue";
</script>
<template>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <Component
            v-bind="$page.props"
            v-if="$root.modalComponent"
            :is="$root.modalComponent"
        />

        <header_top/>

        <transition name="op" mode="in-out">
            <sidebar_menu/>
        </transition>

        <div class="main-content">

            <div class="page-content">
                <slot/>
            </div>
        </div>

        <Footer/>
    </div>

    <div class="rightbar-overlay"></div>
</template>
