<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import HeaderSection from "@/Pages/AboutUs/HeaderSection.vue";
import CardsSection from "@/Pages/AboutUs/CardsSection.vue";

const {t} = useI18n();
</script>

<template>
    <AppLayout :title="t('about-us.title')">
        <HeaderSection/>
        <CardsSection/>
    </AppLayout>
</template>

<style scoped>

</style>
