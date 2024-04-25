<script setup>
import {Head, Link} from '@inertiajs/vue3';
import {ref} from "vue";

const props = defineProps({
    integracao: Object,
    total_imoveis: Number,
    total_imoveis_venda: Number,
    total_imoveis_aluguel: Number,
});

let loading = ref('')

</script>

<template>

    <Head title="Dashboard"/>

    <layout_auth>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <!-- start page title -->
                    <page_title class="pull-left" title="Dashboard"/>
                    <!-- end page title -->
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 mt-4">
                        <div class="row">
                            <div class="table-responsive">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </layout_auth>
</template>
