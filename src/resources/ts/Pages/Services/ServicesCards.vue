<script setup lang="ts">
import ServiceCard from "@/Components/Custom/ServiceCard.vue";
const { t } = useI18n()

const cards = [
    {
        title: t('services.cards.1.title'),
        subtitle: t('services.cards.1.subtitle'),
        price: "100",
        features: [
            t('services.cards.1.features.1'),
            t('services.cards.1.features.2'),
            t('services.cards.1.features.3'),
            t('services.cards.1.features.4'),
            t('services.cards.1.features.5'),
            t('services.cards.1.features.6'),
        ],
        primeIcon: 'pi-file-arrow-up',
        onLearnMore: () => {
            console.log('Card 1 clicked!')
        }
    },
    {
        title: t('services.cards.2.title'),
        subtitle: t('services.cards.2.subtitle'),
        price: "10.11",
        features: [
            t('services.cards.2.features.1'),
            t('services.cards.2.features.2'),
            t('services.cards.2.features.3'),
            t('services.cards.2.features.4'),
            t('services.cards.2.features.5'),
            t('services.cards.2.features.6'),
        ],
        primeIcon: 'pi-globe',
        onLearnMore: () => {
            console.log('Card 2 clicked!')
        }
    }
]
</script>

<template>
    <section :aria-label="t('services.cards.section-aria')" class="mx-auto gap-8 max-w-5xl flex flex-row flex-wrap justify-center place-content-center m-4">
        <ServiceCard class="min-w-xs"
            v-for="(card, index) in cards"
            :key="index"
            :features="card.features" :on-learn-more="card.onLearnMore" :price="card.price"
            :prime-icon="card.primeIcon" :subtitle="card.subtitle" :title="card.title"/>
    </section>
</template>

<style scoped>

</style>
