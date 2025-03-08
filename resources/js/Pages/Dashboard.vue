<script setup>
import HeaderTitle from '@/Components/HeaderTitle.vue';
import Default from '@/Layouts/Default.vue';
import { Head,Link } from '@inertiajs/vue3';


const props = defineProps(['user']);
</script>

<template>
  <Head title="Dashboard" />

  <Default>
    <HeaderTitle>İdarə Paneli</HeaderTitle>


    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <!-- Kullanıcı Bilgileri Kartı -->
        <div class="bg-white shadow-sm sm:rounded-lg mb-8">
          <div class="p-6">
            <h3 class="text-xl font-semibold text-gray-700">Hesab Məlumatlarınız</h3>
            <div class="mt-4">
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div class="flex items-center">
                  <span class="text-gray-600 font-medium">Adınız:</span>
                  <span class="ml-2 text-gray-900">{{ props.user.name }}</span>
                </div>
                <div class="flex items-center">
                  <span class="text-gray-600 font-medium">E-mail:</span>
                  <span class="ml-2 text-gray-900">{{ props.user.email }}</span>
                </div>
                <div class="flex items-center">
                  <span class="text-gray-600 font-medium">Hesabın Yaradılma Tarixi:</span>
                  <span class="ml-2 text-gray-900">{{ new Date(props.user.created_at).toLocaleDateString() }}</span>
                </div>
                <div class="flex items-center">
                  <span class="text-gray-600 font-medium">Son Dəyişdirilme Tarixi:</span>
                  <span class="ml-2 text-gray-900">{{ new Date(props.user.updated_at).toLocaleDateString() }}</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- İstatistikler -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <!-- Aktivite Kartı -->
          <div class="bg-white p-6 rounded-lg shadow-md">

            <h4 class="text-xl font-semibold text-gray-700 mb-4">Idarə Sistemi</h4>
            <Link :href="route('logout')" method="post" class="mt-4 font-bold cursor-pointer flex justify-center items-center w-full bg-black text-white py-2 rounded-md hover:opacity-80 transition-all duration-200" as="button">
              Çıxış et
            </Link>
            <Link href="/profile" class="mt-4 font-bold cursor-pointer flex justify-center items-center w-full bg-black text-white py-2 rounded-md hover:opacity-80 transition-all duration-200">Hesab Məlumatları</Link>
            <Link href="/referral" class="mt-4 font-bold cursor-pointer flex justify-center items-center w-full bg-black text-white py-2 rounded-md hover:opacity-80 transition-all duration-200">Referanslar</Link>
          </div>

          <!-- Bakiye Kartı -->
          <div class="bg-white p-6 rounded-lg shadow-md">
            <h4 class="text-xl font-semibold text-gray-700 mb-4">Balans</h4>
            <div class="text-gray-600">Hazırki balans: <span class="font-medium text-gray-900">{{ props.user.balance }}</span></div>
            <div class="text-gray-600">Referrans Kodu: <span class="font-medium text-gray-900">{{ props.user.referral_code }}</span></div>
            <div class="text-gray-600">Ümumi Xərclənən: <span class="font-medium text-gray-900">{{ props.user.total_spent }}</span></div>
            <div class="text-gray-600">Ümumi Referrans Qazancı: <span class="font-medium text-gray-900">{{ props.user.referral_revenue }}</span></div>
          </div>
          <!-- Çekiliş Kartı -->
       <!--    <div class="bg-white p-6 rounded-lg shadow-md">
            <h4 class="text-xl font-semibold text-gray-700 mb-4">Çekiliş Durumu</h4>
            <div class="text-gray-600">Son başvuru: <span class="font-medium text-gray-900">2 gün önce</span></div>
            <button class="mt-4 w-full bg-black text-white py-2 rounded-md hover:opacity-80 transition-all duration-200">Başvurunu Gör</button>
          </div> -->
        </div>
      </div>
    </div>
  </Default>
</template>

