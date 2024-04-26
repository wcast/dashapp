<template xmlns:pre="http://www.w3.org/1999/html">
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <Link :href="route('dashboard')" class="">
                    <i class="fa fa-desktop"></i> Home
                </Link>
            </li>

            <li v-for="b in breadcrumb" class="breadcrumb-item">

                <Link v-if="b.route"  :href="route(b.route)" class="">
                    {{b.title}}
                </Link>

                <span v-else> {{b.title}} </span>
           </li>

        </ol>
    </nav>
</template>
<script>

import {computed} from "vue";
import {Link, usePage} from "@inertiajs/vue3";

export default {
    name: "AppBreadcrumb",
    components: {
        Link
    },
    setup() {
        const breadcrumb = computed(() => JSON.parse(usePage().props.value.navigation.breadcrumb))
        return {breadcrumb}
    },
    mounted() {

    }
}
</script>

<style scoped>

</style>
