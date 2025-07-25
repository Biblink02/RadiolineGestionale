<script setup lang="ts">

import ImageAndTitle from "@/Components/Custom/ImageAndTitle.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
const {t} = useI18n();
</script>

<template>
    <AppLayout :title="t('proposals.title')">
        <ImageAndTitle src="TODO" :alt="t('proposals.header.image-alt')"/>
        <section class="max-w-4xl mx-auto py-12 px-4 text-center">
            <!-- Titolo -->
            <h2 class="text-3xl font-bold mb-4">
                {{ t('proposals.header.title') }}
            </h2>
            <p class="text-lg text-gray-600 mb-8">
                {{ t('proposals.header.subtitle') }}
            </p>

            <!-- Testo -->
            <p class="text-gray-700 mb-4">
                {{ t('proposals.body.intro') }}
            </p>
            <p class="text-gray-700 mb-10">
                {{ t('proposals.body.pilgrimage') }}
            </p>

            <!-- Cosa fare -->
            <div class="text-center max-w-lg mx-auto">
                <h3 class="text-xl text-center mx-auto font-semibold mb-4 items-center gap-2">
                    <i class="pi pi-pencil"></i>
                    {{ t('proposals.steps.title') }}
                </h3>
                <ol class="list-decimal list-inside space-y-2">
                    <li>{{ t('proposals.steps.step1') }}</li>
                    <li>{{ t('proposals.steps.step2') }}</li>
                </ol>
            </div>

            <!-- Footer -->
            <p class="text-gray-700 mt-8">
                {{ t('proposals.footer.text') }}
            </p>
        </section>
    </AppLayout>
</template>

<style scoped>

</style>
