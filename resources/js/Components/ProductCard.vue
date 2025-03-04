<template>
    <div class="flex flex-col">
        <img :src="'/storage/'+product.image" :alt="product.name">
        <h3 class="text-lg font-medium">{{ product.name }}</h3>
        <p class="text-gray-500">{{ product.price }}</p>
    </div>
</template>
<script setup>
defineProps(['product']);
</script>