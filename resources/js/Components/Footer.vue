<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

</script>

<template>
  <footer class="bg-white text-black pt-12 pb-6">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
      <div>
        <h3 class="font-semibold text-lg mb-4">Menu</h3>
        <ul class="space-y-2">
          <li><Link href="/">Əsas Səhifə</Link></li>
          <li><Link href="/shop">Mağaza</Link></li>
          <li><Link href="/about">Haqqımızda</Link></li>
          <li><Link href="/contact">Əlaqə</Link></li>
          <li><Link href="/dashboard">İdarə Paneli</Link></li>
        </ul>
      </div>
      <div>
        <h3 class="font-semibold text-lg mb-4">Kategoriyalar</h3>
        <ul class="space-y-2">
          
          <li><Link href="/casual">Casual</Link></li>
          <li><Link href="/work-office">Work & Office</Link></li>
          <li><Link href="/activewear">Activewear</Link></li>
          <li><Link href="/evening-dresses">Evening Dresses</Link></li>
        </ul>
      </div>
  <!--     <div>
        <h3 class="font-semibold text-lg mb-4">Resources</h3>
        <ul class="space-y-2">
          <li><Link href="/contact-support">Contact Support</Link></li>
          <li><Link href="/faq">FAQ</Link></li>
          <li><Link href="/live-chat">Live Chat</Link></li>
          <li><Link href="/returns">Returns</Link></li>
        </ul>
      </div> -->
      <div>
        <h3 class="font-semibold text-lg mb-4">Sosiyal Media</h3>
        <ul class="space-y-2">
          <li><a target="_blank" href="https://www.tiktok.com/@koljan.az?_t=ZS-8ud3qC93Gsx&_r=1">TikTok</a></li>
          <li><a target="_blank" href="https://www.instagram.com/koljan.az?igsh=MW1renN2dGhobHBxZA==">Instagram</a></li>
        </ul>
      </div>
    </div>
    <div class="text-center mt-12 text-sm text-gray-600">
      Copyright © 2025 Koljan | Powered by Prestgg
    </div>
  </footer>
</template>

<style>
a {
  @apply hover:text-gray-700 transition-colors duration-300;
}
</style>