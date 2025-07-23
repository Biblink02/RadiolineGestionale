<script setup lang="ts">

import AppLayout from "@/Layouts/AppLayout.vue";
import HeroSection from "@/Pages/Home/HeroSection.vue";
import AboutSection from "@/Pages/Home/AboutSection.vue";
import GallerySectionv1 from "@/Pages/Home/GallerySectionv1.vue";
import GallerySectionv2 from "@/Pages/Home/GallerySectionv2.vue";
import GallerySectionv3 from "@/Pages/Home/GallerySectionv3.vue";
</script>

<template>
    <AppLayout title="Homepage">
        <HeroSection/>
        <AboutSection/>
        <p class="text-center">PROPOSTA GALLERIA IMMAGINI:</p>
        <p class="text-center">v1:</p>
        <GallerySectionv1/>
        <br>
        <p class="text-center">v2:</p>

        <GallerySectionv2/>
        <br>
        <p class="text-center">v3:</p>

        <GallerySectionv3/>
    </AppLayout>
</template>

<style scoped>

</style>
