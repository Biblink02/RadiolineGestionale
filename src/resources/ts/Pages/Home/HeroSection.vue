<script setup lang="ts">
const {t} = useI18n()
import Home_large from "@/../media/1-home-large.png";
import Home_mobile from "@/../media/1-home-mobile.png";

</script>

<template>
    <div class="relative text-white sm:block hidden max-w-3xl mx-auto">
        <img :alt="t('home.hero.title_sr')" :src="Home_large" class="mb-20 aspect-auto w-full"/>

        <div class="absolute left-8/25 top-1/5 transform -translate-x-1/2 -translate-y-1/2 w-fit text-center">
            <h1 class="text-3xl font-bold md:text-4xl max-w-2xl">
                {{ t('home.hero.title') }}:
                <span class="sr-only">{{ t('home.hero.title_sr') }}</span>
            </h1>

            <p class="max-w-2xl text-lg mt-2 text-xl">
                {{ t('home.hero.subtitle1') }}, <br> {{ t('home.hero.subtitle2') }}.
            </p>
        </div>

    </div>

    <div class="relative text-white sm:hidden">
        <img :src="Home_mobile" :alt="t('home.hero.title_sr')" class="mb-6 h-[60vh] w-full"/>
        <div class="w-fit absolute top-26 left-15 mx-auto px-6">
            <h1 class="text-xl font-bold md:text-4xl max-w-2xl mt-8 mx-auto">
                {{ t('home.hero.title') }}:
                <span class="sr-only">{{ t('home.hero.title_sr') }}</span>
            </h1>

            <p class="max-w-2xl mx-auto text-sm">
                {{ t('home.hero.subtitle1') }}, <br> {{ t('home.hero.subtitle2') }}.
            </p>
        </div>
    </div>

</template>


<style scoped>

</style>
