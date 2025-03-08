<template>
    <Default>
      <HeaderTitle>{{ product.name }}</HeaderTitle>
      <Head title="Məhsul Təfərrüatları"/>
      <div class="max-w-6xl mx-auto px-4 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="bg-gray-100 p-5 rounded-xl">
            <img :src="'/storage/' + product.image" :alt="product.name" class="w-full h-auto rounded-lg">
          </div>
          <div class="flex flex-col justify-between">
            <div>
              <h1 class="text-3xl font-bold text-black">{{ product.name }}</h1>
              <p class="text-gray-600 mt-2">{{ product.description }}</p>
              <p class="text-2xl font-semibold text-black mt-4">{{ product.price }}₺</p>
            </div>
  
            <!-- Ölçü Seçimi -->
            <div class="mt-5">
              <h3 class="text-lg font-semibold text-black">Ölçü Seç</h3>
              <div class="flex gap-3 mt-2">
                <button 
                  v-for="size in product.sizes" 
                  :key="size.id"
                  @click="selectedSize = size"
                  :class="selectedSize === size ? 'bg-black text-white' : 'border border-black text-black'"
                  class="px-4 py-2 rounded-lg transition-all duration-200"
                >
                  {{ size.name }}
                </button>
              </div>
            </div>
            <!-- Səbətə Əlavə Et Düyməsi -->
            <button 
              @click="addToCart"
              class="mt-6 bg-black text-white text-lg font-semibold py-3 rounded-lg hover:opacity-80 transition-all duration-200"
            >
              Səbətə Əlavə Et
            </button>
          </div>
        </div>
      </div>
    </Default>
  </template>
  
  <script setup>
  import { Head } from '@inertiajs/vue3';
  import HeaderTitle from '@/Components/HeaderTitle.vue';
  import Default from '@/Layouts/Default.vue';
  import { ref } from 'vue';
  import { useBasketStore } from '@/store/basket';
  import {useToast} from 'vue-toast-notification';

  const toast = useToast({position: 'top-right'});

  const basket = useBasketStore();
  
  const { product } = defineProps(['product']);

  const selectedSize = ref(null);
  
  const addToCart = () => {
    if (!selectedSize.value) {
      toast.error('Ölçü Seçilmədi! Zəhmət olmasa ölçü seçin');
      return;
    }
     basket.addItem({
      product: product,
      size: selectedSize.value,
    }); 
    toast.success(`${product.name} məhsulu səbətə əlavə edildi!`);
    
  };
  </script>
  