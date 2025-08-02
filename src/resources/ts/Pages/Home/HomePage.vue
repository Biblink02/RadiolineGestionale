<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import InspireSection from "@/Pages/Home/InspireSection.vue";
import HeroSection from "@/Pages/Home/HeroSection.vue";
import SocialSection from "@/Pages/Home/SocialSection.vue";
const {t} = useI18n();
</script>

<template>
    <AppLayout :title="t('home.title')">
        <HeroSection/>
        <InspireSection/>
        <SocialSection class="pt-20"/>
    </AppLayout>
</template>

<style scoped>

</style>
