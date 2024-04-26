<script setup>
import {Head, Link, router, useForm, usePage} from '@inertiajs/vue3';
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
    <Head title="Profile"/>
    <layout_auth>

        <Head title="Minha conta"/>

        <!-- start page title -->
        <page_title title="Minha conta"/>
        <!-- end page title -->

        <form @submit.prevent="submit">
            <div class="card">
                <div class="card-body">
                        <div class="row">

                            <div class="col-lg-8 col-md-6 col-sm-12 col-xl-6 mb-3">

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom01">Nome completo</label>
                                    <p>{{ form.name }}</p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom02">E-mail</label>
                                    <p>{{ form.email }}</p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom02">Telefone</label>
                                    <p>{{ form.phone }}</p>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                    <label for="validationCustom02">Celular</label>
                                    <p>{{ form.mobile }}</p>
                                </div>

                            </div>

                            <div class="col-lg-2 col-md-4 col-sm-12 col-xl-2">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>Avatar</label>
                                        <br>
                                        <label class="label-input-file" for="arquivo">Selecionar imagem</label>
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
                </div>
                <div class="card-footer">
                    <button :class="{ 'opacity-25': form.processing }" :disabled="form.processing" class="btn btn-primary float-right" type="submit">
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </layout_auth>
</template>
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

