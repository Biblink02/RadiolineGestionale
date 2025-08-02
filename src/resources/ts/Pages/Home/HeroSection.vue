<script setup lang="ts">
const {t} = useI18n()
import Home1 from "@/../media/1-home.jpg";

</script>

<template>
    <section
        class="relative flex min-h-screen 2xl:min-h-[95vh] items-center justify-center bg-cover bg-fixed bg-left md:bg-center text-white"
        :aria-label="t('home.hero.aria')"
        role="region"
        :style="{ backgroundImage: `linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.6)), url(${Home1})`}"
    >
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold md:text-6xl">
                {{ t('home.hero.title') }}
                <span class="sr-only">{{ t('home.hero.title_sr') }}</span>
            </h1>

            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-200 mt-6">
                {{ t('home.hero.subtitle') }}
            </p>

            <a
                href="/services"
                class="mt-8 inline-block rounded-md bg-blue-800 px-8 py-3 text-lg font-semibold text-white shadow-lg transition-transform hover:scale-105 hover:bg-blue-600"
                :aria-label="t('home.hero.cta_aria')"
            >
                {{ t('home.hero.cta') }}
            </a>
        </div>
    </section>
</template>


<style scoped>

</style>
