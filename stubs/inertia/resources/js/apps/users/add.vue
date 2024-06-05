<script setup>
import {Head, Link, router, useForm, usePage} from '@inertiajs/vue3';
import {computed} from "vue";

import ifExistFile from "@/helpers";

const props = defineProps({
    user: Object
});

const form = useForm({
    name: '',
    email: '',
    mobile: '',
    phone: '',
    status: 'A',
    avatar: '/uploads/no-image.png'
});

const submit = () => {
    form.post(route('users.add.store'), {
        preserveState: true,
        onStart: () => {},
        onFinish: () => {},
        onSuccess: () => {
            const {...userInfo} = computed(() => usePage().props.flash).value;
            swal.fire("Ok!", userInfo.success, "success");
            router.get(route('users'), {method: 'get', preserveState: true})
        }
    });
};

const formData = new FormData();

const upload = (e) => {
    var files = e.target.files || e.dataTransfer.files;
    if (!files.length)
        return;
    createImage(files[0]);
}

var image = new Image();
var reader = new FileReader();

const createImage = (file) => {
    reader.onload = (e) => {
        image = e.target.result;
        form.avatar = image
    };
    reader.readAsDataURL(file);
}
</script>
<template>

    <Head title="Cadastrar novo usuário"/>

    <layout_auth>
        <form @submit.prevent="submit">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                            <!-- start page title -->
                            <page_title title="Adicionar usuário"/>
                            <!-- end page title -->
                            <Link
                                :href="route('users')"
                                class="btn btn-sm btn-clear pull-right">
                                <i class="fa fa-list"></i> Listar todos
                            </Link>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 col-md-6 col-sm-12 col-xl-10">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom01">Nome completo</label>
                                    <input v-model="form.name" class="form-control" name="name" placeholder="Nome completo" required type="text">
                                    <invalid_feedback :message="form.errors.name"/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom02">E-mail</label>
                                    <input v-model="form.email" class="form-control" placeholder="E-mail" required type="email">
                                    <invalid_feedback :message="form.errors.email"/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom02">Telefone</label>
                                    <input v-mask="'(99) 9999-9999'" v-model="form.phone" class="form-control" placeholder="Telefone" type="text">
                                    <invalid_feedback :message="form.errors.phone"/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom02">Celular</label>
                                    <input v-mask="'(99) 99999-9999'" v-model="form.mobile" class="form-control" placeholder="Celular" type="text">
                                    <invalid_feedback :message="form.errors.mobile"/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                    <label>Status</label>
                                    <select v-model="form.status" class="form-control" required>
                                        <option value="A"> Ativo</option>
                                        <option value="S"> Desativado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-12 col-xl-2 line-left">
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <label>Avatar</label>
                                    <div class="custom-file">
                                        <label class="label-input-file" for="arquivo">Selecionar imagem</label>
                                        <input class="file-input" type="file" v-on:change="upload" id="arquivo">
                                        <div class="invalid-feedback">
                                            Informação inválida
                                        </div>
                                        <label class="custom-file-label" for="validationCustomFile"></label>
                                        <div class="invalid-feedback">
                                            Informação inválida
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Pré visualização</label>
                                    <img :src="ifExistFile(form.avatar)" class="avatar-xs rounded" style="width: 70px;height: auto;display: flex">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                            <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="btn btn-primary float-right" type="submit">
                                Salvar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </layout_auth>
</template>
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

