<script setup lang="ts">

import AppLayout from "@/Layouts/AppLayout.vue";
import ImageAndTitle from "@/Components/Custom/ImageAndTitle.vue";
import Jubilee8 from "@/../media/8-jubilee.jpg";

const {t} = useI18n();
</script>

<template>
    <AppLayout :title="t('jubilee.title')">
        <ImageAndTitle class="mt-8" :src="Jubilee8" :alt="t('jubilee.header.image-alt')" image-class="object-[50%_25%]"/>
        <div class="max-w-4xl mx-auto p-6">
            <!-- Titolo -->
            <h1 class="text-2xl font-bold text-center mb-6">
                {{ t('jubilee.body.title') }}
            </h1>

            <!-- Paragrafi -->
            <p class="mb-4">
                {{ t('jubilee.body.paragraph1') }}
            </p>

            <p class="mb-4">
                {{ t('jubilee.body.paragraph2.before-quote') }}
                <span class="italic">
                    "{{ t('jubilee.body.paragraph2.quote') }}"
                </span>
                <span class="italic"> (Spes non confundit, 23).</span>
            </p>

            <p class="mb-4">
                {{ t('jubilee.body.paragraph3.beforeBold') }}
                <span class="font-semibold">{{ t('jubilee.body.paragraph3.bold') }}</span>
                {{ t('jubilee.body.paragraph3.afterBold') }}
            </p>

            <p class="mb-4">
                {{ t('jubilee.body.paragraph4') }}
            </p>
            <hr class="text-gray-400">
            <p class="mt-6">
                <span class="font-bold">
                {{ t('jubilee.body.paragraph5.bold') }}
                </span>
                <span>
                {{ t('jubilee.body.paragraph5.normal') }}
                </span>
            </p>

        </div>
    </AppLayout>
</template>

<style scoped>

</style>
