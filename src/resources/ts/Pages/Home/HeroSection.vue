<script setup lang="ts">
const {t} = useI18n()
import Home1 from "@/../media/1-home-temp.jpg";
import Home_mobile from "@/../media/1-home-mobile.jpg";

</script>

<template>
    <div class="relative text-white sm:block hidden">
        <img :src="Home1" class="mb-20 aspect-auto max-w-3xl mx-auto w-full"/>
        <div class="container absolute top-0 left-30 mx-auto px-6">
            <h1 class="text-3xl font-bold md:text-4xl max-w-2xl mt-8 mx-auto">
                {{ t('home.hero.title') }}:
                <span class="sr-only">{{ t('home.hero.title_sr') }}</span>
            </h1>

            <p class="max-w-2xl mx-auto text-lg mt-2 text-xl">
                {{ t('home.hero.subtitle1') }}, <br> {{ t('home.hero.subtitle2') }}.
            </p>
        </div>
    </div>
    <div class="relative text-white sm:hidden">
        <img :src="Home_mobile" class="mb-20 aspect-auto max-w-3xl mx-auto h-[60vh] w-full"/>

    </div>

</template>


<style scoped>

</style>
