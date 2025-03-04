<script setup>
import Default from '@/Layouts/Default.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';
import HeaderTitle from '@/Components/HeaderTitle.vue';

const form = useForm({
    name: '',
    email: '',
    message: '',
});

const submit = () => {
    form.post(route('contact.send'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <Default>
        <Head title="Əlaqə" />
        <HeaderTitle>Əlaqə</HeaderTitle>

        <div class="max-w-4xl mx-auto py-12 px-6">
            <h2 class="text-2xl font-semibold text-center mb-6">
                Əlaqə Formu
            </h2>

            <form @submit.prevent="submit" class="space-y-6">
                <div>
                    <InputLabel for="name" value="Adınız" />
                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                    />
                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div>
                    <InputLabel for="email" value="E-poçt" />
                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="email"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div>
                    <InputLabel for="message" value="Mesajınız" />
                    <textarea
                        id="message"
                        rows="4"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        v-model="form.message"
                        required
                    ></textarea>
                    <InputError class="mt-2" :message="form.errors.message" />
                </div>

                <div class="flex justify-end">
                    <PrimaryButton
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                    >
                        Göndər
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </Default>
</template>
