<template>
  <Default>
    <HeaderTitle>Səbətiniz</HeaderTitle>
    <Head title="Səbət" />
    <div class="max-w-4xl mx-auto px-4 py-10">
      <div v-if="basket.items.length" class="bg-white p-6 shadow-md rounded-lg">
        <div class="space-y-4">
          <div v-for="item in basket.items" :key="item.product.id" class="border-b pb-4 flex justify-between items-center">
            <div>
              <div class="font-bold text-lg">{{ item.product.name }}</div>
              <div class="text-gray-500">Ölçü: {{ item.size.name }}</div>
              <div class="text-gray-700 font-semibold">Qiymət: {{ item.product.price }} ₼</div>
            </div>
            <div class="flex items-center">
              <button @click="decreaseCount(item)" class="bg-red-500 text-white px-3 py-1 rounded-md">-</button>
              <span class="mx-3 font-bold">{{ item.count }}</span>
              <button @click="increaseCount(item)" class="bg-green-500 text-white px-3 py-1 rounded-md">+</button>
            </div>
          </div>
        </div>
        <div class="mt-6 text-right text-xl font-semibold">
          Toplam: {{ totalPrice }} ₼
        </div>
        <button 
          @click="openModal"
          class="mt-4 w-full bg-black text-2xl font-extrabold text-white py-2 rounded-md hover:opacity-80 transition-all duration-200"
        >
          Ödəniş et
        </button>
      </div>
      <div v-else class="text-center text-gray-500">Səbətiniz boşdur.</div>
    </div>

    <!-- Ödeme Modalı -->
    <div v-if="isModalOpen" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
      <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Ödəniş Məlumatları</h2>
        <p><strong>Kart Kodu:</strong> <span class="text-gray-700">{{ cardCode }}</span></p>
        <p><strong>Ödəniləcək Məbləğ:</strong> <span class="text-gray-700">{{ totalPrice }} ₼</span></p>
        
        <label class="block mt-4 font-semibold">İşlem Kodu:</label>
        <input v-model="transactionCode" type="text" class="w-full border px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-black" placeholder="İşlem kodunu daxil edin">
        
        <label class="block mt-4 font-semibold">Çatdırılma Ünvanı:</label>
        <input v-model="address" type="text" class="w-full border px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-black" placeholder="Adresinizi daxil edin">

        <div class="mt-4 flex justify-end space-x-2">
          <button @click="closeModal" class="px-4 py-2 bg-gray-500 text-white rounded-md">Ləğv et</button>
          <button @click="submitTransaction" class="px-4 py-2 bg-green-600 text-white rounded-md">Təsdiqlə</button>
        </div>
      </div>
    </div>
  </Default>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import HeaderTitle from '@/Components/HeaderTitle.vue';
import Default from '@/Layouts/Default.vue';
import { computed, ref } from 'vue';
import { useBasketStore } from '@/store/basket';
import { useToast } from 'vue-toast-notification';

const toast = useToast({ position: 'top-right' });
const basket = useBasketStore();

const isModalOpen = ref(false);
const transactionCode = ref('');
const address = ref(''); // Adres bilgisi için yeni ref
const cardCode = ref('1234-5678-9012-3456');

const openModal = () => {
isModalOpen.value = true;
};

const closeModal = () => {
isModalOpen.value = false;
transactionCode.value = '';
address.value = ''; // Modal kapanınca adresi temizle
};

const submitTransaction = () => {
if (!transactionCode.value.trim()) {
  toast.error('İşlem kodunu daxil edin!');
  return;
}

if (!address.value.trim()) {
  toast.error('Çatdırılma ünvanınızı daxil edin!');
  return;
}

// İşlem kodu ile ödeme isteği gönder
const form = useForm({
  transaction_code: transactionCode.value,
  address: address.value, // Adresi ekledik
  total_price: totalPrice.value,
  basket_items: basket.items.map(item => ({
    product_id: item.product.id,
    name: item.product.name,
    count: item.count,
    price: item.product.price,
  })),
});

form.post(route('checkout.process'), {
  onSuccess: () => {
    toast.success('Ödəniş uğurla tamamlandı! Çox yaxında təsdiq ediləcək!');
    closeModal();
    basket.items = []; // Sepeti boşalt
  },
  onError: () => {
    toast.error('Ödəniş uğursuz oldu!');
  }
});
};

const increaseCount = (item) => {
item.count++;
toast.success(`${item.product.name} sayısı artırıldı!`);
};

const decreaseCount = (item) => {
if (item.count > 1) {
  item.count--;
  toast.info(`${item.product.name} sayısı azaldıldı!`);
} else {
  basket.items = basket.items.filter(i => i.product.id !== item.product.id);
  toast.error(`${item.product.name} səbətdən çıxarıldı!`);
}
};

const totalPrice = computed(() => {
return basket.items.reduce((sum, item) => sum + item.product.price * item.count, 0);
});
</script>
