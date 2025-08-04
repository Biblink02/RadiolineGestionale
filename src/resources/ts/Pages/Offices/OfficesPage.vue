<script setup lang="ts">
import img from '~/media/office-central.png';
import AppLayout from "@/Layouts/AppLayout.vue";
import {InspireCardData} from "@/Types/InspireCardData";
import InspireCardLink from "@/Components/Custom/InspireCardLink.vue";
import InspireCard from "@/Components/Custom/InspireCard.vue";
import {Link} from "@inertiajs/vue3";

const {t} = useI18n();
const card: InspireCardData = {
    title: t('offices.body.card.title'),
    subtitle: t('offices.body.card.subtitle'),
    buttonOrLink: t('offices.body.card.button'),
    href: 'https://maps.app.goo.gl/sTaZTrP1WC7cu5y99',
    imageSrc: img,
    imageAlt: t('offices.body.card.image-alt')
}
</script>

<template>
    <AppLayout :title="t('offices.title')">
        <h1 class="text-center text-4xl font-bold mt-8">
            {{ t('offices.body.title') }}
        </h1>
        <InspireCard class="max-w-sm mx-auto my-12" :card="card">
            <a v-if="card.buttonOrLink" target="_blank"
                  class="group/button mt-auto mx-auto flex items-center gap-1 text-slate-500 hover:text-blue-600 transition-colors hover:cursor-pointer"
                  :href="card.href"
            >
                {{ t('offices.body.card.button') }}
                <i class="pi pi-arrow-right text-xs transition-transform duration-300 group-hover/button:translate-x-1"></i>
            </a>
        </InspireCard>
    </AppLayout>
</template>

<style scoped>

</style>
