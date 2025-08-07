<script setup lang="ts">
import {Head} from '@inertiajs/vue3';
import Footer from './AppFooter.vue'
import AppHeader from "./AppNavbar.vue";
const props = defineProps<{
    title: string
}>()
</script>

<template>
    <ScrollTop/>
    <div class="bg-gradient-to-br from-stone-100 to-slate-200">
        <Head :title="title"/>

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
