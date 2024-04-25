<script setup>
import {computed, ref} from 'vue'
import {Head, Link, router, useForm, usePage} from '@inertiajs/vue3';
import {InertiaProgress} from '@inertiajs/progress'

const props = defineProps({
    condominium_id: Number,
    condominium: Object,
    units: Object,
    unit: Object,
});

const form = useForm({
    code: '',
    condominium_id: props.condominium_id
});

let loading = ref('')

let search = ref('')

const url = route('condominium.units', props.condominium_id);

const goSearch = () => {
    router.get(url, {search: search}, {preserveState: true, preserveScroll: true}, 300);
}

const deleteItem = (id) => {

    swal.fire({
        title: 'Tem certeza que deseja excluir este registro?',
        text: "Após a exclusão o registro não estará mais disponível!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3f8a27',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, quero excluir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if (result.isConfirmed) {
            axios.post(route('condominium.units.delete', id), {id: id}).then(response => {
                if (response.data.success == true) {
                    swal.fire(
                        'Exclusão de registro',
                        response.data.message,
                        'success'
                    );
                    router.get(url, {search: search}, {preserveState: true, preserveScroll: true}, 300);
                }
            }).catch(error => {
                console.log(error)
            }).finally(() => {
                loading = false
            })
        }
    })
}

const vincular = () => {
    form.post(route('condominium.units.vincular',{id:form.condominium_id}), {
        preserveState: true,
        onStart: () => {
        },
        onFinish: () => {
        },
        onSuccess: () => {
            const {...userInfo} = computed(() => usePage().props.flash).value;
            swal.fire("Ok!", userInfo.success, "success");
            router.visit(route('condominium.units', form.condominium_id), {method: 'get', preserveState: true})
        }
    });
}

const submit = () => {
    form.post(route('condominium.units.store'), {
        preserveState: true,
        onStart: () => {
        },
        onFinish: () => {
        },
        onSuccess: () => {
            const {...userInfo} = computed(() => usePage().props.flash).value;
            swal.fire("Ok!", userInfo.success, "success");
            router.visit(route('condominium.units', form.condominium_id), {method: 'get', preserveState: true})
        }
    });
}
</script>
<template>
    <Head title="Condomínios"/>

    <layout_auth>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <h2>Condomíno {{ props.condominium.name }}</h2>
                        <p>Código Condomínio: {{ props.condominium.code }} </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <!-- start page title -->
                        <page_title title="Unidades do Condomínio"/>
                        <!-- end page title -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-7 col-md-7 col-sm-12 col-xl-7 pull-left mb-3">
                        <div class="form-group">
                            <input v-model="search" class="form-control form-control-inline" name="search" @keyup="goSearch">
                            <button class="btn btn-primary mt-2" @click="goSearch">Pesquisar</button>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-12 col-xl-5 pull-left mb-3pull-right">
                        <label>Informe os códigos</label>
                        <form @submit.prevent="submit" onsubmit="event.preventDefault();" method="post" class=" mb-2">
                            <div class="form-group">
                                <input class="form-control form-control-inline" name="code" v-model="form.code">
                                <input type="hidden" name="condominium_id" v-model="form.condominium_id">
                                <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="btn btn-primary mt-2" type="submit">
                                    Enviar
                                </button>
                                <button @click="vincular" class="btn btn-primary mt-2 ml-5" type="button" style="margin-left: 5px;">
                                    Vincular automaticamente
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="display-only mobile">
                    <template v-for="item in units.data" :key="item.id">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">
                                                    <img :src="item.foto" alt="user" class="avatar-md"/>
                                                    <p class="mb-1 font-size-12">Código {{ item.code }}</p>
                                                    <p class="mb-1 font-size-12">
                                                        <!--                                                    <i v-if="item.status == 'A'" alt="Ativo" class="mdi mdi-check-circle text-success mr-1" title="Ativo"></i>
                                                                                                            <i v-if="item.status == 'S'" alt="Desativado" class="mdi mdi-alert-circle text-warning mr-1" title="Desativado"></i>
                                                                                                            <i v-if="item.status == 'D'" alt="Excluído" class="mdi mdi-close-circle text-danger mr-1" title="Excluído"></i>
                                                                                         --> <a class="m-2" href="#" @click="deleteItem(item.id)">
                                                        <i class="mdi mdi-trash-can-outline text-danger"></i>
                                                    </a>
                                                    </p>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                                        <p class="mb-1 font-size-12"> {{ item.descricao }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="table-responsive display-only deskstop">
                    <table class="table table-striped table-condensed table-bordered mb-0">
                        <thead>
                        <tr>
                            <th scope="col">Foto</th>
                            <th class="text-center" scope="col">Código</th>
                            <th class="text-center" scope="col">Descrição WEB</th>
                            <!--
                                                        <th class="text-center" scope="col" width="5">Status</th>
                            -->
                            <th class="text-center" scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in units.data" :key="item.id">
                            <td class="text-center">
                                <img :src="item.foto" alt="user" class="avatar-md"/>
                            </td>
                            <td class="text-center"><p class="mb-1 font-size-12">{{ item.code }}</p></td>
                            <td>
                                <h5 class="font-size-15 mb-0">{{ item.descricao }}</h5>
                            </td>
                            <!--                            <td class="text-center">
                                                            <i v-if="item.status == 'A'" alt="Ativo" class="mdi mdi-check-circle text-success mr-1" title="Ativo"></i>
                                                            <i v-if="item.status == 'S'" alt="Suspenso" class="mdi mdi-alert-circle text-warning mr-1" title="Desativado"></i>
                                                            <i v-if="item.status == 'D'" alt="Desativado" class="mdi mdi-close-circle text-danger mr-1" title="Excluído"></i>
                                                        </td>-->
                            <td class="text-center" width="100">
                                <a class="m-2" href="#" @click="deleteItem(item.id)">
                                    <i class="mdi mdi-trash-can-outline text-danger"></i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <pagination :links="units.links" class="mt-3"/>
            </div>
        </div>
    </layout_auth>
</template>
