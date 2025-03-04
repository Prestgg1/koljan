<template>
    <button
        class="border border-white px-6 py-2 text-white text-lg font-semibold tracking-wide uppercase hover:bg-white hover:text-black transition-all duration-300"
        :class="customClass"
        @click="$emit('click')"
    >
        <slot></slot>
    </button>
</template>

<script setup>
import { defineProps } from 'vue';

defineProps({
    customClass: {
        type: String,
        default: '',
    },
});
</script>
