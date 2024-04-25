<template>
    <div class="dropdown d-inline-block">
        <button type="button" class="btn header-item dropdown-toggle noti-icon"  id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
            <img class="" src="/assets/images/flags/us.jpg" alt="Header Language" height="14">
        </button>
        <div class="dropdown-menu dropdown-menu-right">

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <img src="/assets/images/flags/spain.jpg" alt="user-image" class="mr-2" height="12"><span class="align-middle">Spanish</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <img src="/assets/images/flags/germany.jpg" alt="user-image" class="mr-2" height="12"><span class="align-middle">German</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <img src="/assets/images/flags/italy.jpg" alt="user-image" class="mr-2" height="12"><span class="align-middle">Italian</span>
            </a>

            <!-- item-->
            <a href="javascript:void(0);" class="dropdown-item notify-item">
                <img src="/assets/images/flags/russia.jpg" alt="user-image" class="mr-2" height="12"><span class="align-middle">Russian</span>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    name: "AppFlags"
}
</script>

<style scoped>

</style>
