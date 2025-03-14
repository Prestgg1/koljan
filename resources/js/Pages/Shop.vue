<script setup lang="ts">
import Default from '@/Layouts/Default.vue';
import HeaderTitle from '@/Components/HeaderTitle.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['products']);
console.log(props.products);
</script>

<template>
    <Default>
        <HeaderTitle>Mağaza</HeaderTitle>

          <div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      <div v-for="product in products" :key="product.id" class="bg-white flex flex-col justify-center gap-3 shadow-lg rounded-lg overflow-hidden">
        <img
    hash="LdHfL}oJR$WBKnfi%3ofT0kCM{ay"
  :src="'/media/'+product.image" :alt="product.name" class="w-full h-64 object-cover"
  />
        <div class="p-4 text-center">
          <h3 class="text-lg font-semibold">{{ product.name }}</h3>
          <p class="text-gray-600">{{ product.price }} AZN</p>

        </div>
        <Link :href="'/shop/'+product.id" class="mt-3 h-12 flex justify-center items-center hover:text-bold text-center hover:text-white hover:text-2xl hover:scale-105 transition-all duration-200  bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
            Satın Al
          </Link>
      </div>
    </div>
  </div>

  <div v-if="products.length === 0" class="text-center w-full text-2xl  text-red-500">Paltar Tapılmadı.</div>

    </Default>
</template>
