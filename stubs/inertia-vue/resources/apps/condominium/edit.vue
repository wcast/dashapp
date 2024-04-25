<script setup>
import {Head, useForm, usePage, Link, router} from '@inertiajs/vue3';
import {computed, onBeforeUnmount, onMounted, reactive, ref, watch, watchEffect} from "vue";

const props = defineProps({
    condominium: Object,
    companies: Object,
});

const auth = computed(() => usePage().props.value.auth);

const form = useForm(props.condominium);

let zipcode = ref(null)
let text_intro = ref(null)
let text_description = ref(null)
const submit = () => {
    form.post(route('condominium.update'), {
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

const getZipcode = (e) => {
    if (e.target.value.length >= 9) {
        axios.get(route('condominium.zipcode', e.target.value)).then(response => {
            if (response.data.cep) {
                form.zipcode = response.data.cep
                form.city = response.data.localidade
                form.district = response.data.bairro
                form.state = response.data.uf
                form.public_place = response.data.logradouro
            }
        }).catch(error => {
            console.log(error)
        }).finally(() => {

        })
    }
}

const mapa = (e) => {
    let files = e.target.files;
    if (files.length) form.mapa = files[0];
}

onMounted(() => {

    text_intro = CKEDITOR.replace('editor-intro', {
        // Define your minimal configuration here
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] }
        ],
        height: 200 // Define the height of the editor
    });

    text_intro.on('change', () => {
        form.intro = text_intro.getData();
    });

    text_description = CKEDITOR.replace('editor-description', {
        // Define your minimal configuration here
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'] }
        ],
        height: 200 // Define the height of the editor
    });

    text_description.on('change', () => {
        form.description = text_description.getData();
    });
})

</script>
<template>
    <Head title="Editar condomínio"/>
    <layout_auth>
        <form @submit.prevent="submit">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12 mb-3">
                            <!-- start page title -->
                            <page_title title="Editar Condomínio"/>
                            <!-- end page title -->
                            <Link
                                :href="route('condominium')"
                                class="btn btn-sm btn-clear pull-right">
                                <i class="fa fa-list"></i> Listar todos
                            </Link>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-12 col-md-6 col-sm-12 col-xl-12">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-12 col-xl-8 mb-3">
                                <label for="validationCustom01">Condomínio</label>
                                <input v-model="form.name" class="form-control" name="name" placeholder="Vera Cruz" required type="text">
                                <invalid_feedback :message="form.errors.name"/>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xl-2 mb-3">
                                <label for="validationCustom01">Código</label>
                                <input v-model="form.code" class="form-control" name="code" placeholder="XXXXX" required type="text">
                                <invalid_feedback :message="form.errors.code"/>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-12 col-xl-2 mb-3">
                                <label>CEP</label>
                                <input id="cep-imovel" v-model="form.zipcode" v-mask="'00000-000'" type="text" class="form-control" placeholder="XX-XXXXXX" required>
                                <invalid_feedback :message="form.errors.zipcode"/>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                <label>Endereço</label>
                                <input id="logradouro" v-model="form.public_place" class="form-control" placeholder="Rua X" type="text">
                                <invalid_feedback :message="form.errors.public_place"/>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                <label>Número</label>
                                <input v-model="form.number" class="form-control" placeholder="XXXX" required type="text">
                                <invalid_feedback :message="form.errors.number"/>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                <label>Bairro</label>
                                <input id="bairro" v-model="form.district" class="form-control" placeholder="São Lourenço" type="text">
                                <invalid_feedback :message="form.errors.district"/>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                <label>Cidade</label>
                                <input id="cidade" v-model="form.city" class="form-control" placeholder="Porto Alegre" type="text" required>
                                <invalid_feedback :message="form.errors.city"/>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xl-3 mb-3">
                                <label>Estado</label>
                                <select v-model="form.state" class="form-control" id="uf" name="estado" required>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espírito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option selected="selected" value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                    <option value="EX">Estrangeiro</option>
                                </select>
                                <invalid_feedback :message="form.errors.state"/>
                            </div>
                            <!--                                <div class="col-lg-3 col-md-3 col-sm-12 col-xl-3 mb-3">
                                                                <label>Blocos</label>
                                                                <input v-model="form.blocks" class="form-control" placeholder="Blocos" type="number">
                                                                <invalid_feedback :message="form.errors.blocks"/>
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-sm-12 col-xl-3 mb-3">
                                                                <label>Unidades</label>
                                                                <input v-model="form.units" class="form-control" placeholder="Unidades" type="number">
                                                                <invalid_feedback :message="form.errors.units"/>
                                                            </div>-->
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xl-3 mb-3">
                                <label>Lançamento</label>
                                <select v-model="form.new" class="form-control" required>
                                    <option selected="selected" value="0">Não</option>
                                    <option value="1"> Sim</option>
                                </select>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-12 col-xl-3 mb-3">
                                <label>Status</label>
                                <select v-model="form.status" class="form-control" required>
                                    <option selected="selected" value="A"> Ativo</option>
                                    <option value="S"> Desativado</option>
                                </select>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-12 col-xl-6 mb-3">
                                <label>Apresentação</label>
                                <textarea id="editor-intro" v-model="form.intro" class="form-control"></textarea>
                                <invalid_feedback :message="form.errors.intro"/>
                            </div>

                            <div class="col-lg-6 col-md-8 col-sm-12 col-xl-6 mb-3">
                                <label>Descrição</label>
                                <textarea id="editor-description" v-model="form.description" class="form-control"></textarea>
                                <invalid_feedback :message="form.errors.description"/>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                <label>Vídeo (YouTube)</label>
                                <input id="video" v-model="form.video" class="form-control" placeholder="https://www.youtube.com/shorts/H4T9bLOiIgM" type="text">
                                <invalid_feedback :message="form.errors.video"/>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                <label>Mapa do condomínio</label>
                                <input type="file" name="mapa" class="form-control" id="content" @change="mapa">
                                <invalid_feedback :message="form.errors.mapa"/>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                <label>Latitude</label>
                                <input id="latitude" v-model="form.latitude" class="form-control" placeholder="" type="text">
                                <invalid_feedback :message="form.errors.latitude"/>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-6 mb-3">
                                <label>Longitude</label>
                                <input id="longitude" v-model="form.longitude" class="form-control" placeholder="" type="text">
                                <invalid_feedback :message="form.errors.longitude"/>
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
