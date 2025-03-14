<script setup>
import Default from '@/Layouts/Default.vue';
import HeaderTitle from '@/Components/HeaderTitle.vue';
import { Head } from '@inertiajs/vue3';
import ReklamCard from '@/Components/ReklamCard.vue';
</script>

<template>
    <Default>
        <Head title="Haqqımızda" />
        <HeaderTitle>Haqqımızda</HeaderTitle>
        <section class="py-16 px-8 max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-semibold italic">Dəbin və Biznesin Birləşdiyi An</h1>
            </div>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-lg font-semibold uppercase text-gray-600">Bizim Hekayəmiz</h2>
                    <p class="mt-4 text-gray-700">
                        Koljan layihəsi 2022-ci ildə texnologiya və modanın inkişaf etdiyi yeni
                        Azərbaycan ideyası olaraq ortaya çıxdı. Elnar Abbaslı tərəfindən düşünülmüş
                        və 2023-cü ildə başlanmış bu start-up, network marketing və modanı
                        birləşdirən unikal bir platformadır.
                    </p>
                    <p class="mt-4 text-gray-700">
                        Günümüzdə hər bir insan - gənc, yaşlı, qadın və kişi - geyim alır. Bu ehtiyacı
                        daha faydalı və gəlirli hala gətirmək məqsədimizdir. Koljan olaraq biz,
                        insanlara keyfiyyətli məhsullar təqdim edərkən, eyni zamanda qazanc
                        əldə etmələrinə dəstək oluruq.
                    </p>
                </div>
            </div>
        </section>

        <section class="py-16 px-8 bg-gray-100 max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-semibold">Network Marketing və Koljan Haqqında</h2>
            </div>
            <div>
                <p class="text-gray-700">
                    Network marketing, məhsulların istehsalçıdan birbaşa alıcıya çatdırıldığı və
                    istifadəçilərin bu sistemdə qazanc əldə edə bildiyi müasir biznes modelidir.
                    Koljan olaraq biz bu modeli daha da təkmilləşdirərək, həm dəbin, həm biznesin
                    eyni platformada birləşməsini təmin edirik.
                </p>
                <p class="mt-4 text-gray-700">
                    Siz Koljana qoşularaq həm keyfiyyətli geyimlər əldə edə, həm də dostlarınızı
                    bu sistemə dəvət edərək passiv gəlir qazana bilərsiniz. Dəvət etdiyiniz hər bir
                    dostunuz, sizin qazanc şəbəkənizə əlavə olunur və bu sistem sizə davamlı gəlir
                    imkanı yaradır.
                </p>
            </div>
        </section>
        <ReklamCard/>
    </Default>
</template>

<style scoped>
section {
    max-width: 1200px;
    margin: 0 auto;
}
</style>