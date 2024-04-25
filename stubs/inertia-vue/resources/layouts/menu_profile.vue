<template>
    <div class="dropdown d-inline-block">
        <button class="btn header-item dropdown-toggle" type="button" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img v-if="auth.user.avatar" class="rounded-circle header-profile-user" :src="ifExistFile(auth.user.avatar)">
            <span class="d-none d-sm-inline-block ml-1">
                {{auth.user.name}}
            </span>
            &nbsp;
            <i class="mdi mdi-chevron-down d-none d-sm-inline-block pt-3"></i>
        </button>
        <div class="dropdown-menu dropdown-menu-right profile-mobile">
            <!-- item-->
            <Link
                :href="route('users.account', auth.user.id)"
                class="dropdown-item">
                <i class="mdi mdi-account-settings font-size-16 align-middle mr-1"></i> Minha conta
            </Link>
            <div class="dropdown-divider"></div>
            <Link :href="route('logout')" method="post" class="dropdown-item" as="button" type="button">
                <i class="mdi mdi-logout font-size-16 align-middle mr-1"></i> Sair
            </Link>
        </div>
    </div>
</template>

<script setup>
import {computed} from "vue";
import ifExistFile from "@/helpers";
import {usePage, Link} from '@inertiajs/vue3';
const auth = computed(() => usePage().props.auth)
const csrf = computed(() => usePage().props.csrf)
import no_image from '../../images/no-image.png'
</script>

<style scoped>
.profile-mobile {
    position: absolute !important;
    transform: translate3d(0px, 70.5px, 0px) !important;
    inset: 0px auto auto 0px !important;
    will-change: transform !important;
    margin: 0px !important;
}

</style>
