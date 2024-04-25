<script setup>
import { Head, useForm } from '@inertiajs/vue3';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <layout_no_auth>
        <Head title="Forgot Password" />

        <div class="mb-4 text-sm text-gray-600">
            Esqueceu sua senha? Sem problemas.<br> Basta nos informar seu endereço de e-mail e enviaremos um e-mail para redefinição de senha,
            o e-mail que permitirá que você troque a sua senha.
        </div>

        <div v-if="status" class="mb-4 alert alert-info">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <label for="email">E-mail</label>
                <text_input
                    id="email"
                    type="email"
                    class="form-control mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />
                <invalid_feedback :message="form.errors.email"/>
            </div>

            <div class="flex items-center justify-end mt-4 mb-5">
                <button class="btn btn-primary" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Envira link de redefinição de senha de e-mail
                </button>
            </div>

            <a class="mt-5" :href="route('login')"><p>Tentar fazer o login novamente</p></a>

        </form>
    </layout_no_auth>
</template>
