<template>
    <div v-if="links.length > 3">
        <ul class="pagination">
            <template v-for="(link, key) in links" :key="key.label">
                <li class="page-item">
                    <Link
                        v-if="link.url"
                        class="page-link"
                        :class="{ 'active': link.active }"
                        :href="link.url"
                        v-html="link.label"
                    />
                </li>
            </template>
        </ul>
    </div>
</template>

<script>
import {defineComponent} from "vue";
import {Link} from "@inertiajs/vue3";

export default defineComponent({
    components: {
        Link,
    },
    props: {
        links: Array,
    },
});
</script>
