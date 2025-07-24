<script setup lang="ts">
import SocialPart from "@/Components/Custom/SocialPart.vue";

const {t} = useI18n()

</script>

<template>
    <section class="section my-10">
        <h2 class="text-center text-3xl font-bold">{{ t('homepage.social.title') }}</h2>
        <p class="text-center text-xl mt-4">{{ t('homepage.social.subtitle') }}</p>
        <SocialPart container-class="text-center my-10 space-x-20" :icon-size="2.5"/>
    </section>
</template>

<style scoped>

</style>
