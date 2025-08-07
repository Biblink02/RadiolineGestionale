<script setup lang="ts">

import ImageAndTitle from "@/Components/Custom/ImageAndTitle.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {Link} from '@inertiajs/vue3';
import {route} from "../../../../vendor/tightenco/ziggy";
import Proposals10 from "@/../media/10-proposals.jpeg";

const {t} = useI18n();
const page = usePage();

</script>

<template>
    <AppLayout :title="t('proposals.title')">
        <ImageAndTitle :src="Proposals10" :alt="t('proposals.header.image-alt')"/>
        <section class="max-w-4xl mx-auto py-12 px-4 text-left">
            <div class="text-center">
                <!-- Titolo -->
                <h1 class="text-3xl font-bold mb-4">
                    {{ t('proposals.header.title') }}
                </h1>
                <p class="text-lg text-gray-600 mb-8">
                    {{ t('proposals.header.subtitle') }}
                </p>
            </div>

            <!-- Testo -->
            <p class="text-gray-700 mb-4">
                {{ t('proposals.body.intro') }}
            </p>
            <p class="text-gray-700 mb-4">
                {{ t('proposals.body.pilgrimage') }}
            </p>
            <p class="text-gray-700 mb-10">
                {{ t('proposals.body.end') }}
            </p>

            <!-- Cosa fare -->
            <div class="text-left max-w-lg">
                <h2 class="text-xl font-semibold mb-4 items-center gap-2">
                    <i class="pi pi-pencil"></i>
                    {{ t('proposals.steps.title') }}
                </h2>
                <ol class="list-decimal list-inside space-y-2">
                    <li>
                        <Link :href="route('page.contact-us', { locale: page.props.locale }, false)" class="underline hover:text-blue-600">
                            {{ t('proposals.steps.step1') }}
                        </Link>
                    </li>
                    <li>{{ t('proposals.steps.step2') }}</li>
                </ol>
            </div>
        </section>
    </AppLayout>
</template>

<style scoped>

</style>
