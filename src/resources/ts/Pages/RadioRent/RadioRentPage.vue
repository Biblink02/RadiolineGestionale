<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import { HugeiconsIcon } from '@hugeicons/vue';
import {RadioIcon} from "@hugeicons/core-free-icons";
import ImageAndTitle from "@/Components/Custom/ImageAndTitle.vue";
import {Link} from "@inertiajs/vue3"
import {route} from "../../../../vendor/tightenco/ziggy";
const {t} = useI18n();
const features = [
    {text: t('radio-rent.body.features.audio'), icon: 'pi pi-volume-up'},
    {text: t('radio-rent.body.features.earphones'), icon: 'pi pi-headphones'},
    {text: t('radio-rent.body.features.instructions'), icon: 'pi pi-language'},
    {text: t('radio-rent.body.features.personalChannel'), icon: 'pi pi-users'},
    {text: t('radio-rent.body.features.translationChannel'), icon: 'pi pi-microphone'},
    {text: t('radio-rent.body.features.barcode'), icon: 'pi pi-barcode'},
    {text: t('radio-rent.body.features.radioList'), icon: 'pi pi-list'},
    {text: t('radio-rent.body.features.battery'), icon: 'pi pi-bolt'},
    {text: t('radio-rent.body.features.delivery'), icon: 'pi pi-truck'},
    {text: t('radio-rent.body.features.support'), icon: 'pi pi-phone'}
]
</script>

<template>
    <AppLayout :title="t('radio-rent.title')">
        <ImageAndTitle :src="'todo'" :alt="t('radio-rent.header.image-alt')" without-text/>
        <div class="max-w-4xl mx-auto p-6">
            <!-- Titolo principale -->
            <h2 class="text-2xl font-bold text-center mb-6">
                {{ t('radio-rent.body.title') }}
            </h2>

            <!-- Sottotitolo servizio -->
            <h3 class="text-lg font-semibold mb-2">
                <HugeiconsIcon :icon="RadioIcon" class="w-6 h-6 inline-block mb-1 mr-2 text-blue-800"/>
                {{ t('radio-rent.body.subtitle') }}
            </h3>

            <!-- Descrizione servizio -->
            <p class="mb-4">
                {{ t('radio-rent.body.intro') }}
            </p>
            <p class="mb-4">
                {{ t('radio-rent.body.benefits') }}
            </p>
            <p class="mb-6">
                {{ t('radio-rent.body.integration') }}
            </p>
            <hr class="text-gray-400 mb-5">

            <!-- Caratteristiche -->
            <h4 class="text-lg font-semibold mb-3">
                {{ t('radio-rent.body.featuresTitle') }}
            </h4>

            <ul class="list-disc mb-6 space-y-1 ml-5">
                <li v-for="(item, index) in features" :key="index" class="relative pl-4">
                    <i :class="item.icon" class="text-blue-800 absolute left-0 top-1"></i>
                    <span class="pl-2">{{ item.text }}</span>
                </li>
            </ul>

            <hr class="text-gray-400 mb-5">

            <!-- Conclusione -->
            <p class="text-left">
                {{ t('radio-rent.body.closure-before-link') }}
                <Link
                    :href="route('page.contact-us', undefined, false)"
                    class="underline hover:text-blue-600"
                >
                    {{ t('radio-rent.body.closure-after-link') }}
                </Link>
                {{ t('radio-rent.body.closure-link') }}
            </p>

        </div>
    </AppLayout>
</template>

<style scoped>

</style>
