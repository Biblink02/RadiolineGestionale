<script setup lang="ts">
import {InspireCardData} from "@/Types/InspireCardData";
const {t} = useI18n()
import InspireCard from "@/Components/Custom/InspireCard.vue";

const cards: InspireCardData[] = [
    {
        title: t('home.inspire.cards.1.title'),
        button: t('home.inspire.cards.1.button'),
        onClick: () => router.visit(route('page.radio-rent', undefined, false)),
        images: [
            {
                src: "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
                alt: t('home.inspire.cards.1.images.1.alt')
            }
        ]
    },
    {
        title: t('home.inspire.cards.2.title'),
        button: t('home.inspire.cards.2.button'),
        onClick: () => router.visit(route('page.proposals', undefined, false)),
        images: [
            {
                src: "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
                alt: t('home.inspire.cards.2.images.1.alt')
            }
        ]
    },
    {
        title: t('home.inspire.cards.3.title'),
        button: t('home.inspire.cards.3.button'),
        onClick: () => router.visit(route('page.jubilee', undefined, false)),
        images: [
            {
                src: "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
                alt: t('home.inspire.cards.3.images.1.alt')
            }
        ]
    }
];

</script>

<template>
    <section class="section my-10">
        <h2 class="text-center text-3xl font-bold">{{t('home.inspire.title')}}</h2>
        <div class="mx-auto gap-8 max-w-5xl flex flex-row flex-wrap justify-center place-content-center m-4 mt-6">
            <InspireCard class="max-w-xs" v-for="card in cards" :card="card" v-animateonscroll="{ enterClass: 'animate-enter fade-in-10 zoom-in-75 animate-duration-1000' }"/>
        </div>
    </section>
</template>

<style scoped>

</style>
