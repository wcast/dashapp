<script setup>
import {Head, Link, router, useForm, usePage} from '@inertiajs/vue3';
import {computed, onMounted, ref, defineComponent, reactive, watch} from "vue";
import ifExistFile from "@/helpers.js";
import {InertiaProgress} from "@inertiajs/progress";

const props = defineProps({
    condominium: Object,
    condominium_photos: Object,
    count: Number,
});

const form = useForm(props.condominium);
const form_photos = useForm(props.condominium_photos);
let photo_titulo = ref('')
let logomarca = ref('')

photo_titulo = 'Foto '+(props.count + 1);

let id = form.id

const formData = new FormData();

var image = new Image();
var reader = new FileReader();

const upload = (e) => {
    var files = e.target.files || e.dataTransfer.files;
    if (!files.length)
        return;
    reader.onload = (e) => {
        image = e.target.result;
        form.default_photo = image;
        axios.post(route('condominium.photo.store', id), {
            id: form.id,
            photo: image
        }).then(response => {
            if (response.data.success == true) {
                swal.fire(
                    'OK',
                    response.data.message,
                    'success'
                );
                Inertia.visit(route('condominium.photos', form.id), {method: 'get'})
            }
        }).catch(error => {
            console.log(error)
        });
    };
    reader.readAsDataURL(files[0]);
}

const uploadSecound = (e) => {
    var files = e.target.files || e.dataTransfer.files;
    if (!files.length)
        return;
    reader.onload = (e) => {
        image = e.target.result;
        form.second_photo = image;
        axios.post(route('condominium.second.photo.store', id), {
            id: form.id,
            photo: image
        }).then(response => {
            if (response.data.success == true) {
                swal.fire(
                    'OK',
                    response.data.message,
                    'success'
                );
                Inertia.visit(route('condominium.photos', form.id), {method: 'get'})
            }
        }).catch(error => {
            console.log(error)
        });
    };
    reader.readAsDataURL(files[0]);
}

const uploadMorePhotos = (e) => {
    var files = e.target.files || e.dataTransfer.files;
    if (!files.length)
        return;
    reader.onload = (e) => {
        image = e.target.result;
        axios.post(route('condominium.photo.more.store', id), {
            id: form.id,
            photo: image,
            name: photo_titulo
        }).then(response => {
            if (response.data.success == true) {
                swal.fire(
                    'OK',
                    response.data.message,
                    'success'
                );
                Inertia.visit(route('condominium.photos', form.id), {method: 'get'})
            }
        }).catch(error => {
            console.log(error)
        });
    };
    reader.readAsDataURL(files[0]);

}
const uploadLogo = (e) => {
    var files = e.target.files || e.dataTransfer.files;
    if (!files.length)
        return;
    reader.onload = (e) => {
        image = e.target.result;
        axios.post(route('condominium.photo.logo.store', id), {
            id: form.id,
            photo: image,
        }).then(response => {
            if (response.data.success == true) {
                swal.fire(
                    'OK',
                    response.data.message,
                    'success'
                );
                Inertia.visit(route('condominium.photos', form.id), {method: 'get'})
            }
        }).catch(error => {
            console.log(error)
        });
    };
    reader.readAsDataURL(files[0]);

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
            axios.post(route('condominium.photo.more.delete'), {id: id}).then(response => {
                if (response.data.success == true) {
                    swal.fire(
                        'Exclusão de registro',
                        response.data.message,
                        'success'
                    )
                    Inertia.visit(route('condominium.photos', form.id), {method: 'get'})
                }
            }).catch(error => {
                console.log(error)
            })
        }
    })
}

onMounted(() => {

})
</script>
<template>
    <Head title="Cadastro de fotos do condomínio"/>
    <layout_auth>
        <form @submit.prevent="submit">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 mb-3">
                            <!-- start page title -->
                            <page_title :title="'Cadastro de fotos '+form.name"/>
                            <!-- end page title -->
                            <Link
                                :href="route('condominium')"
                                class="btn btn-sm btn-clear pull-right">
                                <i class="fa fa-list"></i> Listar todos
                            </Link>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xl-4">
                            <b>Foto principal</b>
                            <img style="max-height: 200px;width: auto;display: flex" :src="ifExistFile(form.default_photo)" class="default-photo">
                            <label>Enviar foto principal</label>
                            <br>
                            <label class="label-input-file" for="arquivo">Selecionar imagem</label>
                            <input class="input-file" type="file" v-on:change="upload" id="arquivo">
                            <div class="invalid-feedback">
                                Informação inválida
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xl-4">
                            <b>Foto secundária</b>
                            <img style="max-height: 200px;width: auto;display: flex" :src="ifExistFile(form.second_photo)" class="default-photo">
                            <label>Enviar foto secundária</label>
                            <br>
                            <label class="label-input-file" for="arquivo2">Selecionar imagem</label>
                            <input class="input-file" type="file" v-on:change="uploadSecound" id="arquivo2">
                            <div class="invalid-feedback">
                                Informação inválida
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xl-4">
                            <b>Logo marca</b>
                            <img style="max-height: 100px;width: auto;display: flex" :src="ifExistFile(form.logomarca)" class="default-photo">
                            <label>Enviar logo marca</label>
                            <br>
                            <label class="label-input-file" for="arquivo3">Selecionar imagem</label>
                            <input class="input-file" type="file" v-on:change="uploadLogo" id="arquivo3">
                            <div class="invalid-feedback">
                                Informação inválida
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 mt-1">
                            <h4>Mais Fotos</h4>
                            <br>
                            <div class="col-lg-3 col-md-12 col-sm-12 col-xl-3">
                                <label>Descrição</label>
                                <input class="form-control" v-model="photo_titulo" name="titulo" type="text">
                            </div>
                            <div class="col-lg-9 col-md-12 col-sm-12 col-xl-9">
                                <label class="label-input-file" for="arquivos">Enviar imagem</label>
                                <input class="input-file" name="fotos" type="file" v-on:change="uploadMorePhotos" id="arquivos">
                                <div class="invalid-feedback">
                                    Informação inválida
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                            <table class="table table-striped table-condensed table-bordered mt-5">
                                <tr>
                                    <th>Foto</th>
                                    <th>Descrição</th>
                                    <th>Excluir</th>
                                </tr>
                                <tr v-for="(p, i) in form_photos.photos" :key="i">
                                    <td width="5"><img style="max-height: 100px;width: auto;display: flex" :src="p.photo"></td>
                                    <td>{{ p.name }}</td>
                                    <td>
                                        <a class="m-2" href="#" @click="deleteItem([p.id])">
                                            <i class="mdi mdi-trash-can-outline text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </layout_auth>
</template>
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<style>
.videoWrapper {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 */
    height: 0;
}

.videoWrapper video {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}
</style>
