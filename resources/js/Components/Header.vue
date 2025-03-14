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
              <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
                                               Kategoriyalar

                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink v-for="category in $page.props.categories" :key="category.id"
                                            :href="'/category/' + category.id"
                                        >
                                            {{ category.name }}
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                               
              <div><NavLink class="text-white" href="/about">Haqqımızda</NavLink></div>
              <div><NavLink class="text-white" href="/contact">Əlaqə</NavLink></div>
              <div><NavLink v-if="$page.props.auth.user" class="text-white" href="/dashboard">İdarə Paneli</NavLink>
              <NavLink v-else class="text-white" href="/login">Daxil Ol</NavLink></div>
              <img src="/assets/logo.webp" alt="" />
          </div>
          <img class="md:hidden" src="/assets/logo.webp" alt="" />

          <!-- Icons -->
          <div class="hidden md:flex space-x-4 text-white">
            <input 
  ref="searchInput" 
  type="text" 
  v-if="isSearchOpen"
  class="border border-gray-300 text-black rounded-md px-3 py-2" 
  placeholder="Axtar..."
  @keyup.enter="handleSearch"
/>
<button @click="handleSearch"><i class="fas fa-search"></i></button>

           
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
           <div class="flex gap-6">
            <button class="block md:hidden"  @click="isSearchOpen? router.visit('/shop?search=' + searchInput.value) : isSearchOpen = !isSearchOpen"><i class="fas text-white fa-search"></i></button>
            <Link href="/basket" class="block md:hidden cursor-pointer relative">
                  <i class="fas text-2xl text-white fa-shopping-bag"></i>
                  <div
                      class="absolute text-sm top-0 -right-2 flex justify-center items-center bg-white text-black w-4 h-4 rounded-full"
                  >
                      {{ basket.items.length }}
                  </div>
              </Link>
          <button @click="toggleMenu" class="md:hidden text-white">
              <i class="fas fa-bars text-2xl"></i>
          </button>
           </div>
        
      </nav>
      <div v-if="isSearchOpen" class="fixed flex md:hidden items-center justify-center inset-0 bg-black bg-opacity-80 ">
        <i @click="isSearchOpen = !isSearchOpen" class="fas fa-xmark text-red-400 text-3xl absolute top-5 right-5"></i>
            <div class="relative">
                <input @keyup.enter="handleSearch" ref="searchInput" type="text" class="border  border-gray-300 text-black rounded-md px-6 text-2xl py-2" placeholder="Axtar...">
                <i @click="handleSearch" class="fas fa-search text-2xl absolute top-1/2 right-0 transform -translate-x-1/2 -translate-y-1/2"></i>
            </div>
      </div>

      <!-- Mobile Fullscreen Menu -->
      <div
          v-if="menuOpen"
          class="fixed inset-0 bg-black gap-5 bg-opacity-90 flex flex-col items-center justify-center text-white text-2xl"
      >
          <button @click="toggleMenu" class="absolute top-5 right-5 text-3xl">&times;</button>
          <NavLink href="/" @click="toggleMenu">Əsas Səhifə</NavLink>
          <NavLink href="/shop" @click="toggleMenu">Mağaza</NavLink>
          <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                            >
                                               Kategoriyalar

                                                <svg
                                                    class="-me-0.5 ms-2 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink v-for="category in $page.props.categories" :key="category.id"
                                            :href="'/category/' + category.id"
                                        >
                                            {{ category.name }}
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
            <NavLink href="/basket" class="flex gap-4 justify-center items-center" @click="toggleMenu">
                <div>Səbət</div>
                  
                <div class="block self-center cursor-pointer relative">
                  <i class="fas text-2xl fa-shopping-bag"></i>
                  <div
                      class="absolute text-sm top-0 -right-2 flex justify-center items-center bg-white text-black w-4 h-4 rounded-full"
                  >
                      {{ basket.items.length }}
                  </div>
                </div>    
            
            </NavLink>
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

import { ref, onMounted, onUnmounted, watch } from 'vue';
import NavLink from './NavLink.vue';
import { Link, router } from '@inertiajs/vue3';
import { useBasketStore } from '@/store/basket';
import DropdownLink from './DropdownLink.vue';
import Dropdown from '@/Components/Dropdown.vue'

const basket = useBasketStore();
const isSearchOpen = ref(false);
const searchInput = ref(null);
const menuOpen = ref(false);
const isScrolled = ref(false);
watch(searchInput, () => {
  if (searchInput.value) {
  /*   isSearchOpen.value = true; */
    console.log(searchInput.value.value)
  }
})

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
const handleSearch = () => {
    if (!isSearchOpen.value) {
        isSearchOpen.value = true;
    }
  const query = searchInput.value?.value.trim(); // Düzgün dəyəri alırıq və boşluqları silirik
  if (query) {
    router.visit(`/shop?search=${query}`);
  }
};
</script>
