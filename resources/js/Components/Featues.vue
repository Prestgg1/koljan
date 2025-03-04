<script setup>
const features = [
  {
    icon: '🔒',
    title: 'Təhlükəsiz Ödəniş',
    description: 'Ödənişləriniz Rəsmi qaydada və Dövlət nəzarətli sistemlərlə edilir.'
  },
  {
    icon: '🚚',
    title: 'Pulsuz Çatdırılma',
    description: 'Sifarişləriniz Paytaxt daxili 1-2 gün, Rayonlara isə 1-3 gün ərzində poçt vasitəsilə çatdırılacaqdır.'
  },
  {
    icon: '↩️',
    title: 'Geri Qaytarma',
    description: 'Alınan məhsullarda hər hansı bir problem yaşandıqda geri qaytarma mövcuddur. Məhsul göndərilmədən əvvəl video olaraq çəkilib saxlanılır.'
  },
  {
    icon: '📍',
    title: 'Sifariş İzləmə',
    description: 'Sifarişi verdikdə konumunuzu düzgün qeyd etdiyinizdən əmin olun. Rayonlara çatdırılmada poçt kodunu düzgün qeyd edin.'
  }
];
</script>

<template>
  <div class="w-full bg-white py-12 px-6">
    <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8 text-center">
      <div v-for="feature in features" :key="feature.title" class="space-y-3">
        <div class="text-3xl">{{ feature.icon }}</div>
        <h3 class="text-lg font-serif font-semibold">{{ feature.title }}</h3>
        <p class="text-gray-600 text-sm">{{ feature.description }}</p>
      </div>
    </div>
  </div>
</template>