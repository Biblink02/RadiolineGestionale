<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import Footer from './AppFooter.vue'
import AppHeader from "./AppNavbar.vue";
import ScrollTop from "@/Components/Custom/ScrollTop.vue";
const props = defineProps<{
    title: string
}>()
</script>

<template>
    <ScrollTop/>

    <Head :title="title"/>

    <!-- Page Heading: sticky header in normal flow, NOT a flex item -->
    <AppHeader/>

    <!-- Ripristinato lo sfondo nel flusso naturale del documento -->
    <div class="min-h-screen flex flex-col justify-between bg-gradient-to-br from-stone-100 to-slate-200">
        <main class="flex-1">
            <slot/>
        </main>

        <Footer/>
    </div>
</template>

<style scoped>
.p-button{
    background: var(--color-primary);
    border: 1px solid var(--color-primary);
}
</style>
