<script setup lang="ts">

import AppLayout from "@/Layouts/AppLayout.vue";

const {t} = useI18n()
</script>

<template>
    <AppLayout :title="t('privacy.title')">
        <div class="max-w-4xl mx-auto p-6 w-fit">
            <!-- Titolo -->
            <h2 class="text-xl font-bold mb-4">
                {{ t('privacy.body.title') }}
            </h2>

            <p class="mb-4">
                {{ t('privacy.body.paragraph1.beforeBold') }}
                <span class="font-bold">Medjugorje Service, </span>,
                {{ t('privacy.body.paragraph1.afterBold') }}
            </p>

            <p class="mb-4">
                {{ t('privacy.body.paragraph2') }}
            </p>

            <p class="mb-4 font-semibold">
                {{ t('privacy.body.paragraph3') }}
            </p>

            <p class="mb-4">
                {{ t('privacy.body.paragraph4.beforeBold') }}
                <span class="font-bold">{{ t('privacy.body.paragraph4.bold') }}</span>
                {{ t('privacy.body.paragraph4.afterBold') }}
            </p>

            <p class="mb-4">
                {{ t('privacy.body.paragraph5.beforeBold') }}
                <span class="font-bold">{{ t('privacy.body.paragraph5.bold') }}</span>
                {{ t('privacy.body.paragraph5.afterBold') }}
            </p>

            <p class="mb-4">
                {{ t('privacy.body.paragraph6.beforeBold') }}
                <span class="font-bold">{{ t('privacy.body.paragraph6.bold') }}</span>
                {{ t('privacy.body.paragraph6.afterBold') }}
            </p>

            <p class="mb-4">
                {{ t('privacy.body.paragraph7.beforeBold') }}
                <span class="font-bold">{{ t('privacy.body.paragraph7.bold') }}</span>
                {{ t('privacy.body.paragraph7.afterBold') }}
            </p>

            <p>
                {{ t('privacy.body.paragraph8.beforeLink') }}
                <span class="font-bold">{{ t('privacy.body.paragraph8.bold') }}</span>
                {{t('privacy.body.paragraph8.afterLink') }}
            </p>
        </div>


    </AppLayout>
</template>

<style scoped>

</style>
