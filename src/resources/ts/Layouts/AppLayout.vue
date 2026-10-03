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
    <!-- Isolated fixed background: renders once, zero paint overhead on scroll in Firefox WebRender -->
    <div class="fixed inset-0 -z-10 pointer-events-none bg-gradient-to-br from-stone-100 to-slate-200" aria-hidden="true"></div>

    <ScrollTop/>

    <Head :title="title"/>

    <!-- Page Heading: sticky header in normal flow, NOT a flex item (avoids Gecko Bug 1488080) -->
    <AppHeader/>

    <!-- Page Content & Footer -->
    <div class="min-h-screen flex flex-col justify-between">
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
