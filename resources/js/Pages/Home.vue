<script setup lang="ts">
import AnimatedButton from '@/Components/AnimatedButton.vue';
import Featues from '@/Components/Featues.vue';
import ReklamCard from '@/Components/ReklamCard.vue';
import Default from '@/Layouts/Default.vue';
import { Head, Link } from '@inertiajs/vue3';


</script>

<template>
    <Default>
        <Head title="Ana Səhifə" />
        <div class="h-screen bg-cover bg-no-repeat bg-center flex items-center justify-center text-center px-6 relative" style="background-image: url('/assets/m.gif');">
            
            <!-- Arka plan için daha belirgin opaklık -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>

            <!-- İçerik -->
            <div class="relative text-white space-y-6 animate-fadeIn">
                <p class="tracking-widest text-sm uppercase opacity-90">Alışverişlərini Daha Sərfəli Et</p>
                <h1 class="text-4xl md:text-6xl font-serif font-bold drop-shadow-lg">
                    Koljanla Həm Dəbi, Həm Də Biznesi Kəşf Et!
                </h1>
                <p class="max-w-xl mx-auto text-lg opacity-90 drop-shadow-md">
                    Koljan size normal qiymətinə aldığınız paltarları daha fərqli tonlar qataraq alışverişi daha sərfəli və daha gəlirli edir.
                    Sadəcə bir T-shirt qiymətinə Biznesə qoşularaq real Bizneslə məşğul olun.
                </p>
                <Link href="/shop" as="button" class="border border-white px-6 py-2 text-white text-lg font-semibold tracking-wide uppercase hover:bg-white hover:text-black transition-all duration-300">
                    Kolleksiyalar
                </Link>
            </div>
        </div>
        
        <Featues/>
        <ReklamCard/>
    </Default>
</template>

<style>
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fadeIn {
    animation: fadeIn 1s ease-out;
}
</style>
