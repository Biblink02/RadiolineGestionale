<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import ServicesHeader from "@/Pages/Services/ServicesHeader.vue";
import ServicesCards from "@/Pages/Services/ServicesCards.vue";
const {t} = useI18n()

</script>

<template>
    <AppLayout :title="t('services.title')">
        <ServicesHeader/>
        <ServicesCards/>
    </AppLayout>
</template>

<style scoped>

</style>
