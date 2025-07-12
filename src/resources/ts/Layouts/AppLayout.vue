<script setup>
import { useI18n } from 'vue-i18n'
const { t } = useI18n()
import {Head, router} from '@inertiajs/vue3';
import Banner from '@/Components/inertia/Banner.vue';
import Footer from './AppFooter.vue'
import AppHeader from "./AppHeader.vue";

defineProps({
    title: String,
});

</script>

<template>
    <ScrollTop
        :pt="{
                root: {
                    style: { background: 'var(--color-primary)', border: 'var(--color-primary)' },
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
