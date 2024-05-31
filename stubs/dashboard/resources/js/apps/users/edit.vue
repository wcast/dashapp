<script setup>
import {Head, useForm, usePage, Link, router} from '@inertiajs/vue3';
import {computed} from "vue";

import ifExistFile from "@/helpers";

const props = defineProps({
    user: Object,
    perfis: Object,
});

const form = useForm(props.user);

const submit = () => {
    form.post(route('users.edit.update'), {
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

    <Head title="Editar usuário"/>

    <layout_auth>

        <form @submit.prevent="submit">
            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 mb-3">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 mb-3">
                            <!-- start page title -->
                            <page_title title="Editar usuário"/>
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
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom01">Nome completo</label>
                                    <input type="text" v-model="form.name" name="name" class="form-control" placeholder="Nome completo" required>
                                    <invalid_feedback :message="form.errors.name"/>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom02">E-mail</label>
                                    <input v-model="form.email" type="email" class="form-control" placeholder="E-mail" required>
                                    <invalid_feedback :message="form.errors.email"/>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom02">Telefone</label>
                                    <input v-mask="'(99) 9999-9999'" type="text" v-model="form.phone" class="form-control" placeholder="Telefone">
                                    <invalid_feedback :message="form.errors.phone"/>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom02">Celular</label>
                                    <input v-mask="'(99) 99999-9999'" v-model="form.mobile" type="text" class="form-control" placeholder="Celular">
                                    <invalid_feedback :message="form.errors.mobile"/>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 mb-3">
                                    <label>Perfil</label>
                                    <select v-model="form.perfil_id" class="form-control" required>
                                        <option value=""> Selecione</option>
                                        <option v-for="(perfil, i) in props.perfis" :key="i" :value="perfil.id">{{ perfil.name }}</option>
                                    </select>
                                    <invalid_feedback :message="form.errors.perfil_id"/>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xl-6 mb-3">
                                    <label>Status</label>
                                    <select v-model="form.status" class="form-control" required>
                                        <option value="A"> Ativo</option>
                                        <option value="S"> Desativado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1 col-md-12 col-sm-12 col-xl-1">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label>Avatar</label>
                                    <br>
                                    <label class="label-input-file" for="arquivo">Selecionar</label>
                                    <input class="file-input" type="file" v-on:change="upload" id="arquivo">
                                    <div class="invalid-feedback">
                                         Informação inválida
                                     </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Visualização</label>
                                    <img style="width: 70px;height: auto;display: flex" :src="ifExistFile(form.avatar)" class="avatar-xs rounded">
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
            </div>
        </form>
    </layout_auth>
</template>
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

