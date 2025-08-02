<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import Banner from '@/Components/Inertia/Banner.vue';
import Footer from './AppFooter.vue'
import AppHeader from "./AppNavbar.vue";

const props = defineProps<{
    title: string
}>()
</script>

<template>
    <ScrollTop/>
    <div class="bg-gradient-to-br from-stone-100 to-slate-200">
        <Head :title="title">
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        </Head>
        <div class="min-h-screen">

            <!-- Page Heading -->
            <AppHeader/>

            <!-- Page Content -->
            <main>
                <slot/>
            </main>
        </div>
        <Footer/>
    </div>
</template>

<style scoped>
.p-button{
    background: var(--color-primary);
    border: 1px solid var(--color-primary);
}
</style>
