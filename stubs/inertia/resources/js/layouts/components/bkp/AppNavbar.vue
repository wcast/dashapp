<template>
    <div class="topnav">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <template v-for="(first , index) in sidebar">
                            <li v-if="!first.second_item" class="nav-item">
                                <a class="nav-link" :href="first.href">
                                    <i class="mdi mdi-storefront mr-2"></i>{{ first.title }}
                                </a>
                            </li>

<!--
                            <li class="nav-item dropdown mega-dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-format-underline mr-2"></i>UI Elements <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu mega-dropdown-menu" aria-labelledby="topnav-uielement">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h2 class="segment-dropdown-menu">Cadastros</h2>
                                            <div>
                                                <a href="ui-alerts.html" class="dropdown-item">Alerts</a>
                                                <a href="ui-badge.html" class="dropdown-item">Badge</a>
                                                <a href="ui-buttons.html" class="dropdown-item">Buttons</a>
                                                <a href="ui-cards.html" class="dropdown-item">Cards</a>
                                                <a href="ui-dropdowns.html" class="dropdown-item">Dropdowns</a>
                                                <a href="ui-navs.html" class="dropdown-item">Navs</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <h2 class="segment-dropdown-menu">Tarefas</h2>
                                            <div>
                                                <a href="ui-tabs-accordions.html" class="dropdown-item">Tabs &amp; Accordions</a>
                                                <a href="ui-modals.html" class="dropdown-item">Modals</a>
                                                <a href="ui-images.html" class="dropdown-item">Images</a>
                                                <a href="ui-progressbars.html" class="dropdown-item">Progress Bars</a>
                                                <a href="ui-pagination.html" class="dropdown-item">pagination</a>
                                                <a href="ui-popover-tooltips.html" class="dropdown-item">Popover & Tooltips</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <h2 class="segment-dropdown-menu">Relatórios</h2>
                                            <div>
                                                <a href="ui-spinner.html" class="dropdown-item">Spinner</a>
                                                <a href="ui-carousel.html" class="dropdown-item">Carousel</a>
                                                <a href="ui-video.html" class="dropdown-item">Video</a>
                                                <a href="ui-typography.html" class="dropdown-item">Typography</a>
                                                <a href="ui-grid.html" class="dropdown-item">Grid</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>
-->

                            <li v-if="first.second_item" class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button"
                                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="mdi mdi-cloud-print-outline mr-2"></i>{{ first.title }}
                                    <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" :key="index" aria-labelledby="topnav-components">
                                    <template v-for="(second, index) in first.second_item">
                                        <div v-if="second.third_item" class="dropdown">
                                            <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{ second.title }}
                                                <div class="arrow-down"></div>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="topnav-email">
                                                <template v-for="(third, index) in second.third_item">
                                                    <div v-if="third.fourth_item" class="dropdown">
                                                        <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                                           role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {{ third.title }}
                                                            <div class="arrow-down"></div>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="topnav-email">
                                                            <template v-for="(fourth, index) in third.fourth_item">
                                                                <a :href="fourth.href" class="dropdown-item">
                                                                    {{ fourth.title }}
                                                                </a>
                                                            </template>
                                                        </div>
                                                    </div>
                                                    <a v-if="!third.fourth_item" :href="third.href" class="dropdown-item">
                                                        {{ third.title }}
                                                    </a>
                                                </template>
                                            </div>
                                        </div>
                                        <a v-if="!second.third_item" :href="second.href" class="dropdown-item">
                                            {{ second.title }}
                                        </a>
                                    </template>
                                </div>
                            </li>
                        </template>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</template>

<script>
import {computed} from 'vue'
import {usePage} from '@inertiajs/vue3'

export default {
    name: "AppNavbarTop",
    setup() {
        const isOpen = []
        const theme = 'sidebar'
        const chevronRight = 'chevron-right'
        const sidebar = computed(() => JSON.parse(usePage().props.value.navigation.menu))
        return {sidebar}
    },
}
</script>

<style scoped>

</style>
