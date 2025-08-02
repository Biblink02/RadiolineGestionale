<script setup lang="ts">
const {t} = useI18n()
import Home1 from "@/../media/1-home.jpg";

</script>

<template>
    <section
        class="relative flex min-h-[70vh] lg:min-h-[75vh] items-center justify-center bg-cover bg-fixed bg-[15%_50%] text-white"
        :aria-label="t('home.hero.aria')"
        role="region"
        :style="{ backgroundImage: `url(${Home1})`}"
    >
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold md:text-6xl">
                {{ t('home.hero.title') }}
                <span class="sr-only">{{ t('home.hero.title_sr') }}</span>
            </h1>

            <p class="mt-12 max-w-2xl mx-auto text-lg mt-6 text-xl">
                {{ t('home.hero.subtitle') }}
            </p>
        </div>
    </section>
</template>


<style scoped>

</style>
