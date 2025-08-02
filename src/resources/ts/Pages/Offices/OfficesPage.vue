<script setup lang="ts">
import img from '~/media/office-central.png';
import AppLayout from "@/Layouts/AppLayout.vue";
import InspireCard from "@/Components/Custom/InspireCard.vue";
import {InspireCardData} from "@/Types/InspireCardData";

const {t} = useI18n();
const card: InspireCardData = {
    title: t('offices.body.card.title'),
    subtitle: t('offices.body.card.subtitle'),
    button: t('offices.body.card.button'),
    onClick: () => window.open('https://maps.app.goo.gl/sTaZTrP1WC7cu5y99', '_blank', 'noopener,noreferrer'),
    imageSrc: img,
    imageAlt: t('offices.body.card.image-alt')
}
</script>

<template>
    <AppLayout :title="t('offices.title')">
        <h1 class="text-center text-4xl font-bold mt-8">
            {{ t('offices.body.title') }}
        </h1>
        <InspireCard class="max-w-sm mx-auto my-12" :card="card"/>
    </AppLayout>
</template>

<style scoped>

</style>
