<script setup lang="ts">
import HeaderTitle from '@/Components/HeaderTitle.vue';
import Default from '@/Layouts/Default.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
</script>

<template>
    <Head title="Pul Çıxarışı" />

    <Default>
        <HeaderTitle>Pul Çıxarışı</HeaderTitle>

        <!-- Çekilmek İstenen Miktar ve Kart Bilgisi İçin Form -->
        <div class="max-w-md my-5 mx-auto p-6 bg-white rounded-lg shadow-md">
            <div class="mb-4">
                <label for="cardCode" class="block text-sm font-semibold text-gray-700">Kart Kodu</label>
                <input
                    id="cardCode"
                    type="text"
                    class="w-full p-3 border border-gray-300 rounded-md mt-2"
                    placeholder="Kart Kodu (16 Haneli)"
                />
            </div>

            <div class="mb-6">
                <label for="withdrawAmount" class="block text-sm font-semibold text-gray-700">Çekiləcək Məbləğ</label>
                <input
                    id="withdrawAmount"
                    type="number"
                    class="w-full p-3 border border-gray-300 rounded-md mt-2"
                    placeholder="Çekiləcək Məbləği Girin"
                    min="1"
                />
            </div>

            <button
                class="w-full bg-black text-white py-3 rounded-md text-xl font-bold hover:opacity-80 transition-all duration-200"
            >
                Pul Çıxar
            </button>
        </div>
    </Default>
</template>

