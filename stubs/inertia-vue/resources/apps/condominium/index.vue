<script setup>
import {computed, ref} from 'vue'
import {Head, Link, router, useForm, usePage} from '@inertiajs/vue3';
import {InertiaProgress} from '@inertiajs/progress'
import ifExistFile from "@/helpers";

const props = defineProps({
    condominium: Object,
    perfis: Object,
});

const form = useForm({
    code: ''
});

let loading = ref('')

let search = ref('')

const url = route('condominium');

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
            InertiaProgress.init({color: '#4B5563'});
            axios.post(route('condominium.delete'), {id: id}).then(response => {
                if (response.data.success == true) {
                    swal.fire(
                        'Exclusão de registro',
                        response.data.message,
                        'success'
                    )
                    Inertia.visit(route('condominium'), {method: 'get', data: search})
                }
            }).catch(error => {
                console.log(error)
            }).finally(() => {
                loading = false
            })
        }
    })
}

const registrar = () => {
    form.post(route('condominium.register'), {
        preserveState: true,
        onStart: () => {
        },
        onFinish: () => {
        },
        onSuccess: () => {
            const {...userInfo} = computed(() => usePage().props.flash).value;
            if(userInfo.success){
                swal.fire("Ok!", userInfo.success, "success");
                router.visit(route('condominiums'), {method: 'get', preserveState: true})
            }else{
                swal.fire("Ok!", userInfo.error, "error");
                router.visit(route('condominiums'), {method: 'get', preserveState: true})
            }
        },
        onError: () => {

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
                        <!-- start page title -->
                        <page_title title="Condomínios"/>
                        <!-- end page title -->
                        <Link
                            :href="route('condominium.add')"
                            class="btn btn-sm btn-clear pull-right">
                            <i class="fa fa-plus"></i> Novo cadastro
                        </Link>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 pull-left mb-3">
                        <div class="form-group">
                            <input v-model="search" class="form-control form-control-inline" name="search" @keyup="goSearch">
                            <button class="btn btn-primary mt-2" @click="goSearch">Pesquisar</button>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-12 col-xl-5 pull-left mb-3pull-right">
                        <form @submit.prevent="submit" onsubmit="event.preventDefault();" method="post" class=" mb-2">
                            <div class="form-group">
                                <input class="form-control form-control-inline" placeholder="LUXXXXX" name="code" v-model="form.code">
                                <button @click="registrar" class="btn btn-primary mt-2 ml-5" type="button" style="margin-left: 5px;">
                                    Registrar Condomínio
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="display-only mobile">
                    <template v-for="item in condominium.data" :key="item.id">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">
                                                    {{ item.name }}
                                                    <i v-if="item.status == 'A'" alt="Ativo" class="mdi mdi-check-circle text-success mr-1" title="Ativo"></i>
                                                    <i v-if="item.status == 'S'" alt="Desativado" class="mdi mdi-alert-circle text-warning mr-1" title="Desativado"></i>
                                                    <i v-if="item.status == 'D'" alt="Excluído" class="mdi mdi-close-circle text-danger mr-1" title="Excluído"></i>
                                                </h5>
                                                <p class="mb-1 font-size-12">Código {{ item.code }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <p class="mb-0 mt-3 text-muted">{{ item.district }}</p>
                                        <p class="mb-0 mt-3 text-muted">{{ item.city }}</p>
                                        <p class="mb-0 mt-3 text-muted">{{ item.state }}</p>
                                        <p class="mb-0 mt-3 text-muted">{{ item.zipcode }}</p>
                                        <p class="mb-0 mt-3 text-muted">
                                            <Link
                                                :href="route('condominium.edit',item.id)"
                                                class="m-2">
                                                <i class="mdi mdi-square-edit-outline text-secondary"></i>
                                            </Link>

                                            <a class="m-2" href="#" @click="deleteItem(item.id)">
                                                <i class="mdi mdi-trash-can-outline text-danger"></i>
                                            </a>
                                        </p>
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
                            <th scope="col">Condomínio</th>
                            <th class="text-center" scope="col">Código</th>
                            <th class="text-center" scope="col">Cep</th>
                            <th class="text-center" scope="col" width="5">Status</th>
                            <th class="text-center" scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in condominium.data" :key="item.id">
                            <td class="text-center" width="5">
                                <img style="max-width: 100px;min-width: 100px;" :src="ifExistFile(item.logomarca)" alt="user" class=""/>
                            </td>
                            <td>
                                <h5 class="font-size-15 mb-0">{{ item.name }}</h5>
                                <p class="mb-1 font-size-12">{{ item.public_place }}, {{ item.number }} {{ item.district }} - {{ item.city }} - {{ item.state }}</p>
                            </td>
                            <td class="text-center"><p class="mb-1 font-size-12">{{ item.code }}</p></td>
                            <td class="text-center"><p class="mb-1 font-size-12">{{ item.zipcode }}</p></td>
                            <td class="text-center">
                                <i v-if="item.status == 'A'" alt="Ativo" class="mdi mdi-check-circle text-success mr-1" title="Ativo"></i>
                                <i v-if="item.status == 'S'" alt="Suspenso" class="mdi mdi-alert-circle text-warning mr-1" title="Desativado"></i>
                                <i v-if="item.status == 'D'" alt="Desativado" class="mdi mdi-close-circle text-danger mr-1" title="Excluído"></i>
                            </td>
                            <td class="text-center" width="180">
                                <Link
                                    :href="route('condominium.edit',item.id)"
                                    class="m-2">
                                    <i class="mdi mdi-square-edit-outline text-secondary"></i>
                                </Link>
                                <Link title="Unidades do condomínio"
                                      :href="route('condominium.units',item.id)"
                                      class="m-2">
                                    <i class="mdi mdi-office-building-cog text-secondary"></i>
                                </Link>
                                <Link title="Fotos do condomínio"
                                      :href="route('condominium.photos',item.id)"
                                      class="m-2">
                                    <i class="mdi mdi-image text-secondary"></i>
                                </Link>
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
                <pagination :links="condominium.links" class="mt-3"/>
            </div>
        </div>
    </layout_auth>
</template>

