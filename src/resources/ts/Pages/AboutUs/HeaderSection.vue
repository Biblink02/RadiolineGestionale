<script setup lang="ts">
import ImageAndTitle from "@/Components/Custom/ImageAndTitle.vue";

const { t } = useI18n();
</script>

<template>
    <section class="w-full my-8">
        <!-- Immagine banner con testo centrale -->
        <ImageAndTitle src="https://www.operaromanapellegrinaggi.org/uploads/slideshow_item/image/120/fill_1400x708_490122475137.jpg" :alt="t('about-us.header.image-alt')"/>



        <!-- Testo -->
        <div class="max-w-5xl mx-auto px-4 py-12 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                {{ t('about-us.header.title') }}
            </h2>
            <h3 class="text-xl text-gray-700 mb-6">
                {{ t('about-us.header.subtitle') }}
            </h3>
            <p class="text-lg text-gray-600 leading-relaxed mb-4">
                {{ t('about-us.header.paragraph-1') }}
            </p>
            <p class="text-lg text-gray-600 leading-relaxed">
                {{ t('about-us.header.paragraph-2') }}
            </p>
        </div>
    </section>
</template>

<style scoped>
</style>
