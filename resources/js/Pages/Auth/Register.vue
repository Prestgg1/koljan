<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import HeaderTitle from '@/Components/HeaderTitle.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import Default from '@/Layouts/Default.vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Default>
        <HeaderTitle>
            Qeydiyyat
        </HeaderTitle>
        <Head title="Register" />

        <form @submit.prevent="submit" class="w-1/2 mx-auto py-10">
    <div>
        <InputLabel for="name" value="Ad" />

        <TextInput
            id="name"
            type="text"
            class="mt-1 block w-full"
            v-model="form.name"
            required
            autofocus
            autocomplete="name"
        />

        <InputError class="mt-2" :message="form.errors.name" />
    </div>

    <div class="mt-4">
        <InputLabel for="email" value="E-poçt" />

        <TextInput
            id="email"
            type="email"
            class="mt-1 block w-full"
            v-model="form.email"
            required
            autocomplete="username"
        />

        <InputError class="mt-2" :message="form.errors.email" />
    </div>

    <div class="mt-4">
        <InputLabel for="password" value="Şifrə" />

        <TextInput
            id="password"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password"
            required
            autocomplete="new-password"
        />

        <InputError class="mt-2" :message="form.errors.password" />
    </div>

    <div class="mt-4">
        <InputLabel
            for="password_confirmation"
            value="Şifrəni təsdiqləyin"
        />

        <TextInput
            id="password_confirmation"
            type="password"
            class="mt-1 block w-full"
            v-model="form.password_confirmation"
            required
            autocomplete="new-password"
        />

        <InputError
            class="mt-2"
            :message="form.errors.password_confirmation"
        />
    </div>

    <div class="mt-4 flex items-center justify-end">
        <Link
            :href="route('login')"
            class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
            Artıq qeydiyyatdan keçmisiniz?
        </Link>

        <PrimaryButton
            class="ms-4"
            :class="{ 'opacity-25': form.processing }"
            :disabled="form.processing"
        >
            Qeydiyyatdan keç
        </PrimaryButton>
    </div>
</form>

    </Default>
</template>
