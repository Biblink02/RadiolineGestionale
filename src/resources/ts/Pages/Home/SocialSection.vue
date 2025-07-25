<script setup lang="ts">
import SocialPart from "@/Components/Custom/SocialPart.vue";

const {t} = useI18n()

</script>

<template>
    <section class="section my-10 mb-20">
        <h2 class="text-center text-3xl font-bold">{{ t('home.social.title') }}</h2>
        <p class="text-center text-xl mt-4">{{ t('home.social.subtitle') }}</p>
        <SocialPart v-animateonscroll="{ enterClass: 'animate-enter fade-in-10 slide-in-from-b-20 animate-duration-1000' }" container-class="text-center my-10 space-x-20" :icon-size="2.5"/>
    </section>
</template>

<style scoped>

</style>
