<script setup lang="ts">
const {t} = useI18n()
const images = ref([
    { src: 'https://www.operaromanapellegrinaggi.org/uploads/slideshow_item/mobile_image/1402/MDJGR-0-TESTATA-MOBILE-435x465.jpg', alt: t('homepage.gallery.image1.alt') },
    { src: 'https://rusconiviaggi.it/wp-content/uploads/2024/07/Pellegrinaggio-a-Medjugorje-da-Verona_Rusconi-Viaggi-e-Pellegrinaggi.jpg', alt: t('homepage.gallery.image2.alt') },
    { src: 'https://www.madonnadellabozzola.org/wp-content/uploads/2024/04/Medjugorje-24-scaled.jpg', alt: t('homepage.gallery.image3.alt') },
    { src: 'https://rusconiviaggi.it/wp-content/uploads/2024/07/Pellegrinaggio-a-Medjugorje-da-Verona_Rusconi-Viaggi-e-Pellegrinaggi.jpg', alt: t('homepage.gallery.image4.alt') }
]);
</script>

<template>
    <section class="py-12 bg-gray-100">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Galleria di Medjugorje</h2>
            <Carousel :value="images" :numVisible="1" :numScroll="1" circular autoplayInterval="2000">
                <template #item="slotProps">
                    <img :src="slotProps.data.src" :alt="slotProps.data.alt" class="w-full h-96 object-cover rounded-lg shadow-lg" />
                </template>
            </Carousel>
        </div>
    </section>
</template>

<style scoped>
</style>
