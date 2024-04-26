<script setup>
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <layout_no_auth>

        <Head title="Reset Password" />

        <form @submit.prevent="submit">

            <input type="hidden" v-model="form.email">

            <!-- start page title -->
            <page_title title="Alteração de senha"/>
            <!-- end page title -->

            <p>Olá, estamos quase lá, agora informe sua nova senha com no mínimo 8 digitos.</p>

            <div v-if="form.errors.email" class="mb-4 mt-2 alert alert-info">
                {{ form.errors.email }}
            </div>


            <div class="mt-4">
                <label for="password">Informe uma nova senha</label>

                <text_input
                    id="password"
                    type="password"
                    class="form-control form-control-lg form-control-solid"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <div v-show="form.errors.password">
                    <p class="text-sm text-red">
                        {{ form.errors.password }}
                    </p>
                </div>

            </div>

            <div class="mt-4">
                <label for="password_confirmation">Confirme a senha acima</label>

                <text_input
                    id="password_confirmation"
                    type="password"
                    class="form-control form-control-lg form-control-solid"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                <div v-show="form.errors.password_confirmation">
                    <p class="text-sm text-red">
                        {{ form.errors.password_confirmation }}
                    </p>
                </div>

            </div>

            <div class="flex items-center justify-end mt-4">

                <button class="btn btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reset Password
                </button>

            </div>
        </form>
    </layout_no_auth>
</template>
