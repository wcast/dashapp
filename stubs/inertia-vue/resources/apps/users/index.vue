<script setup>
import {computed, ref} from 'vue'
import {Head, Link, router, usePage} from '@inertiajs/vue3';
import {InertiaProgress} from '@inertiajs/progress'
import ifExistFile from '@/helpers';

const props = defineProps({
    users: Object,
    perfis: Object,
});

let loading = ref('')

const search = ref(''); //Should really load it from the query string

const url = route('users');

const goSearch = () => {
    router.get(url, {search: search}, {preserveState: true, preserveScroll: true}, 300);
}

const submit = () => {
    form.post(route('condominium.units.store'), {
        preserveState: true,
        onStart: () => {},
        onFinish: () => {},
        onSuccess: () => {
            const {...userInfo} = computed(() => usePage().props.flash).value;
            swal.fire("Ok!", userInfo.success, "success");
            router.get(route('condominium'), {method: 'get', preserveState: true})
        }
    });
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

            axios.post(route('users.delete'), {id: id}).then(response => {
                if (response.data.success == true) {
                    swal.fire(
                        'Exclusão de registro',
                        response.data.message,
                        'success'
                    )
                    Inertia.visit(route('users'), {method: 'get', data: search})
                }
            }).catch(error => {
                console.log(error)
            }).finally(() => {
                loading = false
            })
        }
    })
}
</script>
<template>
    <Head title="Usuários"/>

    <layout_auth>

        <div class="card">

            <div class="card-body">

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <!-- start page title -->
                        <page_title title="Usuários"/>
                        <!-- end page title -->
                        <Link
                            :href="route('users.add')"
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
                </div>
                <div class="display-only mobile">
                    <template v-for="item in users.data" :key="item.id">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <div class="media">
                                            <div class="media-body">
                                                <h5 class="font-size-14">
                                                    <img :src="item.avatar" alt="user" class="avatar-xs rounded-circle"/>
                                                    {{ item.name }}
                                                    <i v-if="item.status == 'A'" alt="Ativo" class="mdi mdi-check-circle text-success mr-1" title="Ativo"></i>
                                                    <i v-if="item.status == 'S'" alt="Desativado" class="mdi mdi-alert-circle text-warning mr-1" title="Desativado"></i>
                                                    <i v-if="item.status == 'D'" alt="Excluído" class="mdi mdi-close-circle text-danger mr-1" title="Excluído"></i>
                                                </h5>
                                                <p class="mb-1 font-size-12">{{ item.email }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                        <p class="mb-0 mt-3 text-muted">{{ item.phone }}</p>
                                        <p class="mb-0 mt-3 text-muted">{{ item.mobile }}</p>
                                        <p class="mb-0 mt-3 text-muted">
                                            <Link
                                                :href="route('users.edit',item.id)"
                                                class="m-2">
                                                <i class="mdi mdi-square-edit-outline text-secondary"></i>
                                            </Link>
                                            <a class="m-2" href="#" @click="deleteItem([item.id])">
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
                            <th scope="col" width="5">Avatar</th>
                            <th scope="col">Nome / E-mail</th>
                            <th scope="col">Telefone</th>
                            <th scope="col">Celular</th>
                            <th class="text-center" scope="col">Perfil</th>
                            <th class="text-center" scope="col" width="5">Status</th>
                            <th class="text-center" scope="col">Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in users.data" :key="item.id">
                            <td class="text-center">
                                <img :src="ifExistFile(item.avatar)" alt="user" class="avatar-xs rounded-pill"/>
                            </td>
                            <td>
                                <h5 class="font-size-15 mb-0">{{ item.name }}</h5>
                                <p class="mb-1 font-size-12">{{ item.email }}</p>
                            </td>
                            <td><p class="mb-1 font-size-12">{{ item.phone }}</p></td>
                            <td><p class="mb-1 font-size-12">{{ item.mobile }}</p></td>
                            <td class="text-center"><p class="mb-1 font-size-12">{{ item.perfil.sigla }}</p></td>
                            <td class="text-center">
                                <i v-if="item.status == 'A'" alt="Ativo" class="mdi mdi-check-circle text-success mr-1" title="Ativo"></i>
                                <i v-if="item.status == 'S'" alt="Desativado" class="mdi mdi-alert-circle text-warning mr-1" title="Desativado"></i>
                                <i v-if="item.status == 'D'" alt="Excluído" class="mdi mdi-close-circle text-danger mr-1" title="Excluído"></i>
                            </td>
                            <td class="text-center" width="100">

                                <Link
                                    :href="route('users.edit',item.id)"
                                    class="m-2">
                                    <i class="mdi mdi-square-edit-outline text-secondary"></i>
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
                <pagination :links="users.links" class="mt-3"/>
            </div>
        </div>
    </layout_auth>
</template>
