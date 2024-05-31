<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';

import githubIcon from '../../../images/wcast.png'

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <layout_no_auth>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 alert-info">
            {{ status }}
        </div>

        <form @submit.prevent="submit">

            <img :src="githubIcon">

            <div>
                <label for="email">E-mail</label>

                <text_input
                    id="email"
                    class="form-control form-control-lg form-control-solid"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />
                <invalid_feedback :message="form.errors.email"/>
            </div>

            <div class="mt-4">
                <label for="password">Senha</label>

                <text_input
                    id="password"
                    type="password"
                    class="form-control form-control-lg form-control-solid"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
                <invalid_feedback :message="form.errors.password"/>
            </div>

            <div class="col-12 mt-4 ml-2">

                <label class="text-center">

                    <input
                        type="checkbox"
                        v-model="form.remember"
                        class="form-check-input me-2"
                    />

                    <span class="form-label fs-6">Remember me</span>

                </label>
            </div>

            <div class="mt-4 mr-0">
                <button type="submit" class="btn btn-dark col-12" :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                    Entrar
                </button>
            </div>

            <div class="mt-4 mr-0">
                <Link v-if="canResetPassword" :href="route('password.request')" class="form-label fs-6">
                    Esqueceu sua senha?
                </Link>
            </div>
        </form>
    </layout_no_auth>
</template>
<style>

</style>
