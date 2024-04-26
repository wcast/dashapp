<template>
    <!-- ========== Left Sidebar Start ========== -->
    <div class="vertical-menu">
        <div data-simplebar class="h-100">
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <!-- Left Menu Start -->
                <ul id="side-menu" class="metismenu list-unstyled">
                    <template v-for="(first , a) in sidebar" :key="a">
                        <li v-if="first.segment" class="menu-title">
                            <span :title="first.description">{{ first.segment }}</span>
                        </li>
                        <li v-if="first.sub_menus.length == 0">
                            <Link
                                :href="route(first.route)">
                                <i v-if="first.icon" :class="first.icon"></i>
                                <span :title="first.description">{{ first.title }}</span>
                                <span :class="'badge-'+first.info" class="badge float-right">{{ first.info_text }}</span>
                            </Link>
                        </li>

                        <li v-if="first.sub_menus.length > 0">
                            <a class="has-arrow " href="javascript: void(0);">
                                <i v-if="first.icon" :class="first.icon"></i>
                                <span :title="first.description">{{ first.title }}</span>
                            </a>
                            <ul aria-expanded="true" class="sub-menu mm-collapse">
                                <template v-for="(second , b) in first.sub_menus" :key="b">
                                    <li v-if="second.sub_menus.length == 0">
                                        <Link
                                            :href="route(second.route)"
                                            class="">
                                            <i v-if="second.icon" :class="second.icon"></i>
                                            <span :title="second.description">{{ second.title }}</span>
                                        </Link>
                                    </li>
                                    <li v-if="second.sub_menus.length > 0">
                                        <a class="has-arrow " href="javascript: void(0);">
                                            <span :title="second.description">{{ second.title }}</span>
                                        </a>
                                        <ul aria-expanded="true" class="sub-menu">
                                            <template v-for="(third , b) in second.sub_menus" :key="b">
                                                <li v-if="third.sub_menus.length == 0">
                                                    <Link
                                                        :href="route(third.route)"
                                                        class="">
                                                        <i v-if="third.icon" :class="third.icon"></i>
                                                        <span :title="third.description">{{ third.title }}</span>
                                                    </Link>
                                                </li>
                                                <li v-if="third.sub_menus.length > 0">
                                                    <a class="has-arrow " href="javascript: void(0);">
                                                        <span :title="third.description">{{ third.title }}</span>
                                                    </a>
                                                    <ul aria-expanded="true" class="sub-menu">
                                                        <template v-for="(fourth , c) in third.sub_menus" :key="c">
                                                            <li>
                                                                <Link
                                                                    :href="route(fourth.route)"
                                                                    class="">
                                                                    <i :class="fourth.icon"></i>
                                                                    <span :title="fourth.description">{{ fourth.title }}</span>
                                                                </Link>
                                                            </li>
                                                        </template>
                                                    </ul>
                                                </li>
                                            </template>
                                        </ul>
                                    </li>
                                </template>
                            </ul>
                        </li>
                    </template>
                </ul>
                <div class="sidebar-section mt-5 mb-3">
<!--                    <h6 class="text-reset font-weight-medium">
                        Project Completed
                        <span class="float-right">67%</span>
                    </h6>
                    <div class="progress mt-3" style="height: 4px;">
                        <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="67" class="progress-bar bg-warning" role="progressbar" style="width: 67%"></div>
                    </div>-->
                </div>
            </div>
            <!-- Sidebar -->
        </div>
    </div>
    <!-- Left Sidebar End -->
</template>


<script>
import {computed} from 'vue'
import {Link, usePage} from '@inertiajs/vue3'

export default {
    name: "AppSideBarMenu",
    components: {
        Link
    },
    setup() {
        const isOpen = []
        const theme = 'sidebar'
        const chevronRight = 'chevron-right'
        const sidebar = computed(() => usePage().props.navigation.menu)
        return {sidebar}
    },
    mounted() {
        $("#side-menu").metisMenu();
        $('#vertical-menu-btn').on('click', function (event) {
            event.preventDefault();
            if($('body').hasClass('sidebar-enable')){
                if ($(window).width() < 993){ // Mobile
                    $('body').removeClass('sidebar-enable');
                }else{ // Desktop
                    $('body').removeClass('vertical-collpsed');
                    $('body').removeClass('sidebar-enable');
                }
            }else{
                if ($(window).width() < 993){ // Mobile
                    $('body').addClass('sidebar-enable');
                }else{ // Desktop
                    $('body').addClass('vertical-collpsed');
                    $('body').addClass('sidebar-enable');
                }
            }
        });

        $('.container-fluid').on('click', function () {
            if ($(window).width() <= 992) {
                if($('body').hasClass('sidebar-enable')){
                    $('body').toggleClass('sidebar-enable');
                }
            }
        });

        $("#sidebar-menu a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];

            if (this.href == pageUrl) {

                $(this).addClass("active-menu")

                $(this).parent().addClass("mm-active")
                $(this).parent().parent().addClass("mm-show");

                $(this).parent().parent().prev().addClass("mm-active");
                $(this).parent().parent().addClass("mm-active");
                $(this).parent().parent().parent().addClass("mm-show");

                $(this).parent().parent().parent().prev().addClass("mm-active");
                $(this).parent().parent().parent().addClass("mm-active");
                $(this).parent().parent().parent().parent().addClass("mm-show");

                $(this).parent().parent().parent().prev().addClass("mm-active");
                $(this).parent().parent().parent().parent().addClass("mm-show");

                $(this).parent().parent().parent().parent().prev().addClass("mm-active");
                $(this).parent().parent().parent().parent().parent().addClass("mm-show");
            }
        });

        $(".navbar-nav a").each(function () {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if (this.href == pageUrl) {
                $(this).addClass("active");
                $(this).parent().addClass("active");
                $(this).parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().parent().parent().addClass("active");
                $(this).parent().parent().parent().parent().parent().parent().parent().parent().addClass("active");
            }
        });

        $('[data-toggle="fullscreen"]').on("click", function (e) {
            e.preventDefault();
            $('body').toggleClass('fullscreen-enable');
            if (!document.fullscreenElement && /* alternative standard method */ !document.mozFullScreenElement && !document.webkitFullscreenElement) {  // current working methods
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.mozRequestFullScreen) {
                    document.documentElement.mozRequestFullScreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                }
            } else {
                if (document.cancelFullScreen) {
                    document.cancelFullScreen();
                } else if (document.mozCancelFullScreen) {
                    document.mozCancelFullScreen();
                } else if (document.webkitCancelFullScreen) {
                    document.webkitCancelFullScreen();
                }
            }
        });
        document.addEventListener('fullscreenchange', exitHandler);
        document.addEventListener("webkitfullscreenchange", exitHandler);
        document.addEventListener("mozfullscreenchange", exitHandler);

        function exitHandler() {
            if (!document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
                console.log('pressed');
                $('body').removeClass('fullscreen-enable');
            }
        }

        $(".vertical-menu ul li a").on('click', function () {
            setTimeout(function () {
              //  $('body').removeClass('sidebar-enable');
            }, 1000)
        });

        // right side-bar toggle
        $('.right-bar-toggle').on('click', function (e) {
            $('body').toggleClass('right-bar-enabled');
        });

        $(document).on('click', 'body', function (e) {
            if ($(e.target).closest('.right-bar-toggle, .right-bar').length > 0) {
                return;
            }
            $('body').removeClass('right-bar-enabled');
            return;
        });

        $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
            if (!$(this).next().hasClass('show')) {
                $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
            }
            var $subMenu = $(this).next(".dropdown-menu");
            $subMenu.toggleClass('show');

            return false;
        });

    }
}
</script>

<style scoped>

</style>
