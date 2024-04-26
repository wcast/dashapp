<template>
    <header id="page-topbar">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- App Logo-->
                <ApplicationLogo/>
                <!-- Button Bars-->
                <button_bars/>
                <!-- App Search-->
                <AppSearch/>
            </div>
            <div class="d-flex">
                <!-- App Mobile Serch-->
                <AppMobileSerch/>
                <!--App Button FullScreen-->
                <AppButtonFullScreen/>
                <!--App Button RigthBar-->
<!--
                <AppButtonRigthBar/>
-->
                <!--App Notifications-->
<!--
                <AppNotifications/>
-->
                <!--App Menu Profile-->
                <AppMenuProfile/>
            </div>
        </div>
    </header>
</template>

<script setup>
import ApplicationLogo from "@/components/ApplicationLogo.vue";
import button_bars from "@/components/button_bars.vue";
import AppSearch from "@/components/AppSearch.vue";
import AppMobileSerch from "@/components/AppMobileSerch.vue";
import AppButtonFullScreen from "@/components/AppButtonFullScreen.vue";
import AppButtonRigthBar from "@/components/AppButtonRigthBar.vue";
import AppNotifications from "@/components/AppNotifications.vue";
import AppMenuProfile from "@/components/AppMenuProfile.vue";
</script>

<style scoped>

</style>
