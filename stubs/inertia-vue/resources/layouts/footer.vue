<script setup>
import { Head, Link } from '@inertiajs/vue3';
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

let path = window.location.pathname;

if((path.search("login") != -1)  || (path.search("forgot-password") != -1)  || (path.search('reset-password') != -1)){
    $('body').addClass('bg-login');
    $('body').removeClass('bg-geral');
    $(document).ready(function () {
        document.getElementById("footer").style.left = "0px";

    })
}else{
    $('body').addClass('bg-geral');
    $('body').removeClass('bg-login');
}

</script>
<template>
    <footer class="footer" id="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    2022 © DeskStore.
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-right d-none d-sm-block">
                        by WCast Sistemas
                    </div>
                </div>
            </div>
        </div>
    </footer>
</template>
<style scoped>

</style>
