<script setup lang="ts">

import AppLayout from "@/Layouts/AppLayout.vue";
import HeroSection from "@/Pages/Home/HeroSection.vue";
import AboutSection from "@/Pages/Home/AboutSection.vue";
</script>

<template>
    <AppLayout :title="'Homepage'">
        <HeroSection/>
        <AboutSection/>
    </AppLayout>
</template>

<style scoped>

</style>
