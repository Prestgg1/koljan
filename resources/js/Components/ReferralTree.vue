<script setup>
import ReferralNode from '@/Components/ReferralNode.vue';

defineProps(['user']);
</script>

<template>
    <div class="p-6 bg-white shadow rounded">
        <h2 class="text-lg font-bold mb-4">Referans Ağacı</h2>
        <ReferralNode :node="user" />
    </div>
</template>
