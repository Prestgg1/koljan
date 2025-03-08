<template>
  
  <header
      ref="header"
      class="fixed top-0 left-0 w-full z-50 transition-all duration-300"
      :class="{ 'bg-black bg-opacity-80': isScrolled, 'bg-transparent': !isScrolled }"
  >
      <nav class="container mx-auto flex justify-between md:justify-around items-center p-4">
          <!-- Logo -->

          <!-- Desktop Menu -->
          <div class="hidden md:flex space-x-6 items-center">
              <div><NavLink class="text-white" href="/">Əsas Səhifə</NavLink></div>
              <div><NavLink class="text-white" href="/shop">Mağaza</NavLink></div>
              <div><NavLink class="text-white" href="/about">Haqqımızda</NavLink></div>
              <div><NavLink class="text-white" href="/contact">Əlaqə</NavLink></div>
              <div><NavLink v-if="$page.props.auth.user" class="text-white" href="/dashboard">İdarə Paneli</NavLink>
              <NavLink v-else class="text-white" href="/login">Daxil Ol</NavLink></div>
              <img src="/assets/logo.webp" alt="" />
          </div>
          <img class="md:hidden" src="/assets/logo.webp" alt="" />

          <!-- Icons -->
          <div class="hidden md:flex space-x-4 text-white">
              <button><i class="fas fa-search"></i></button>
              <Link href="/basket" class="block cursor-pointer relative">
                  <i class="fas text-2xl fa-shopping-bag"></i>
                  <div
                      class="absolute text-sm top-0 -right-2 flex justify-center items-center bg-white text-black w-4 h-4 rounded-full"
                  >
                      {{ basket.items.length }}
                  </div>
              </Link>
          </div>

          <!-- Mobile Menu Button -->
          <button @click="toggleMenu" class="md:hidden text-white">
              <i class="fas fa-bars text-2xl"></i>
          </button>
      </nav>

      <!-- Mobile Fullscreen Menu -->
      <div
          v-if="menuOpen"
          class="fixed inset-0 bg-black gap-5 bg-opacity-90 flex flex-col items-center justify-center text-white text-2xl"
      >
          <button @click="toggleMenu" class="absolute top-5 right-5 text-3xl">&times;</button>
          <NavLink href="/" @click="toggleMenu">Əsas Səhifə</NavLink>
          <NavLink href="/shop" @click="toggleMenu">Mağaza</NavLink>
          <NavLink href="/about" @click="toggleMenu">Haqqımızda</NavLink>
          <NavLink href="/contact" @click="toggleMenu">Əlaqə</NavLink>
          <NavLink href="/admin" @click="toggleMenu">İdarə Paneli</NavLink>
      </div>
  </header>
</template>

<script setup>
defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    }
});

import { ref, onMounted, onUnmounted } from 'vue';
import NavLink from './NavLink.vue';
import { Link } from '@inertiajs/vue3';
import { useBasketStore } from '@/store/basket';

const basket = useBasketStore();
const menuOpen = ref(false);
const isScrolled = ref(false);

const toggleMenu = () => {
  menuOpen.value = !menuOpen.value;
};

const handleScroll = () => {
  isScrolled.value = window.scrollY > 50; // 50px-dən çox aşağı düşüldükdə fon dəyişsin
};

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>
