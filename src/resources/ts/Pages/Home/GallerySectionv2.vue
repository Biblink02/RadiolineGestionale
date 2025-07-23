<script setup lang="ts">
const images = [
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAlaRIJqVwMC2ym91g3pO53kyPByMZR9j_7Q&s',
    'https://www.operaromanapellegrinaggi.org/uploads/slideshow_item/mobile_image/1402/MDJGR-0-TESTATA-MOBILE-435x465.jpg',
    'https://www.madonnadellabozzola.org/wp-content/uploads/2024/04/Medjugorje-24-scaled.jpg',
    'https://www.sanfrancescodelprato.it/wp-content/uploads/2025/03/Medju2024-1024x578.jpg',
    'https://rusconiviaggi.it/wp-content/uploads/2024/07/Pellegrinaggio-a-Medjugorje-da-Verona_Rusconi-Viaggi-e-Pellegrinaggi.jpg',
    'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQAlaRIJqVwMC2ym91g3pO53kyPByMZR9j_7Q&s',
];
</script>

<template>
    <section class="py-12 bg-gray-100">
        <div class="max-w-5xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-6">Galleria di Medjugorje</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <Image
                    v-for="(img, index) in images"
                    :key="index"
                    :src="img"
                    alt="Medjugorje"
                    preview
                    imageClass="w-full h-60 object-cover rounded-lg shadow-lg hover:scale-105 transition-transform"
                >
                    <template #indicatoricon>
                        <i class="pi pi-search"></i>
                    </template>
                </Image>
            </div>
        </div>
    </section>
</template>
<style scoped>
</style>
