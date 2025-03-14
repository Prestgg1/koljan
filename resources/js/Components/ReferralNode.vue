<script setup>
defineProps({ node: Object });
</script>

<template>
    <div class="flex flex-col items-center">
        <!-- Ana Kullanıcı (Kök) -->
        <div  class="relative flex  flex-col items-center">
            <div class="bg-black  text-white px-4 py-2 rounded-lg font-semibold">
                {{ node.name }}
            </div>
        
        </div>

        <!-- Altındaki Referanslar -->
        <div v-if="node.referrals.length" class="flex justify-center space-x-6 mt-2 relative">
            <!-- Her referansı yatay olarak yaymak için -->
            <div v-for="ref in node.referrals" :key="ref.id" class="relative">
                <!-- Çizgi: Üstten gelen bağlantı -->
                <div class="absolute top-[-12px] left-1/2 w-5 h-3 "></div>
                <ReferralNode :node="ref" />
            </div>
        </div>
    </div>
</template>
