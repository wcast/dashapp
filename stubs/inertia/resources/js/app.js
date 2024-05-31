import './bootstrap';
import '../css/app.css';
import "../scss/app.scss";
// AdminKit (required)
import "./modules/bootstrap";
import "./modules/theme";
import "./modules/feather";
import "./modules/sidebar";

import $ from 'jquery'
import jQuery from 'jquery'
import {createApp, h} from 'vue';
import {createInertiaApp, Link, Head} from '@inertiajs/vue3';
import {resolvePageComponent} from 'laravel-vite-plugin/inertia-helpers';
import {ZiggyVue} from '../../vendor/tightenco/ziggy';
import Select2 from 'vue3-select2-component';
import pagination from '@/layouts/pagination.vue'
import {VueDraggableNext} from 'vue-draggable-next'
import page_title from '@/layouts/page_title.vue'
import layout_auth from '@/layouts/layout_auth.vue'
import layout_no_auth from '@/layouts/layout_no_auth.vue'
import header_top from '@/layouts/header_top.vue'
import invalid_feedback from "@/layouts/invalid_feedback.vue";
import button_bars from '@/layouts/button_bars.vue';
import sidebar_menu from '@/layouts/sidebar_menu.vue';
import footer_page from '@/layouts/footer.vue';
import breadcrumb from '@/layouts/breadcrumb.vue';
import app_logo from '@/layouts/app_logo.vue';
import search from '@/layouts/search.vue';
import mobile_search from '@/layouts/mobile_search.vue';
import button_full_screen from '@/layouts/button_full_screen.vue';
import menu_profile from '@/layouts/menu_profile.vue';
import text_input from '@/layouts/components/text_input.vue';
//const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
import useModal from "@/layouts/modal.vue";
import VueMask from '@devindex/vue-mask';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./apps/${name}.vue`, import.meta.glob('./apps/**/*.vue')),
    setup({el, App, props, plugin}) {
        return createApp({render: () => h(App, props)})
            .use(plugin)
            .use(ZiggyVue)
            .use(VueMask)
            .component('modal', useModal)
            .component('page_title', page_title)
            .component('layout_auth', layout_auth)
            .component('layout_no_auth', layout_no_auth)
            .component('header_top', header_top)
            .component('invalid_feedback', invalid_feedback)
            .component('button_bars', button_bars)
            .component('text_input', text_input)
            .component('footer_page', footer_page)
            .component('button_full_screen', button_full_screen)
            .component('app_logo', app_logo)
            .component('search', search)
            .component('mobile_search', mobile_search)
            .component('menu_profile', menu_profile)
            .component('breadcrumb', breadcrumb)
            .component('sidebar_menu', sidebar_menu)
            .component('Head', Head)
            .component('Link', Link)
            .component('Select2', Select2)
            .component('draggable', VueDraggableNext)
            .component('pagination', pagination)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});


