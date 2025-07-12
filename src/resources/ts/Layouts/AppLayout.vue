<script setup>
import {Head} from '@inertiajs/vue3';
import Banner from '@/Components/inertia/Banner.vue';
import Footer from './AppFooter.vue'
import AppHeader from "./AppHeader.vue";

defineProps({
    title: String,
});

</script>

<template>
    <!-- TODO non si vede il blu -->
    <ScrollTop
        :pt="{
                root: {
                    style: { background: '--color-black', border: 'var(--color-primary)' },
                },
            }"
    />
    <div class="bg-gradient-to-br from-stone-100 to-slate-200">
        <Head :title="title"/>

        <Banner/>

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

</style>
