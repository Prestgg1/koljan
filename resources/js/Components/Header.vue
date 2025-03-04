<template>
    <header class="fixed top-0 left-0 w-full bg-transparent z-50">
      <nav class="container mx-auto flex justify-around items-center p-4">
        <!-- Logo -->
  
        <!-- Desktop Menu -->
        <div class="hidden md:flex space-x-6 items-center">
          <div><NavLink class="text-white" href="/">Əsas Səhifə</NavLink></div>
          <div><NavLink class="text-white" href="/shop">Mağaza</NavLink></div>
          <div><NavLink class="text-white" href="/about">Haqqımızda</NavLink></div>
          <div><NavLink class="text-white" href="/contact">Əlaqə</NavLink></div>
          <div><NavLink class="text-white" href="/admin">İdarə Paneli</NavLink></div>
        <img src="/assets/logo.webp" alt="">

        </div>

        <!-- Icons -->
        <div class="hidden md:flex space-x-4 text-white">
          <button><i class="fas fa-search"></i></button>
          <button><i class="fas fa-shopping-bag"></i></button>
        </div>
  
        <!-- Mobile Menu Button -->
        <button @click="toggleMenu" class="md:hidden text-white">
          <i class="fas fa-bars text-2xl"></i>
        </button>
      </nav>
  
      <!-- Mobile Fullscreen Menu -->
      <div v-if="menuOpen" class="fixed inset-0 bg-black bg-opacity-90 flex flex-col items-center justify-center text-white text-2xl">
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
import { ref } from 'vue';
import NavLink from './NavLink.vue';

const menuOpen = ref(false);

const toggleMenu = () => {
  menuOpen.value = !menuOpen.value;
};
  </script>
  
  <style>
  /* Arkaplan transparan kalacak */
  </style>