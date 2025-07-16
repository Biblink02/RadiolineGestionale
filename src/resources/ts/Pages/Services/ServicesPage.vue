<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import ServiceCard from "@/Components/Custom/ServiceCard.vue";
import ServiceHeader from "@/Pages/Services/ServiceHeader.vue";

const cards = [
    {
        title: 'UI/UX Design',
        subtitle: 'Beautiful, user-centered designs that convert visitors into customers',
        price: '$1,899',
        features: [
            'User research & analysis',
            'Wireframing & prototyping',
            'Visual design systems',
            'Usability testing',
            'Brand consistency',
            'Design documentation'
        ],
        primeIcon: 'pi-palette',
        onLearnMore: () => {
            console.log('UI/UX Design clicked!')
        }
    },
    {
        title: 'Web Development',
        subtitle: 'Robust and scalable web applications built with modern frameworks',
        price: '$2,499',
        features: [
            'Responsive design',
            'Backend API integration',
            'Performance optimization',
            'SEO best practices',
            'Cross-browser compatibility',
            'Unit & integration testing'
        ],
        primeIcon: 'pi-code',
        onLearnMore: () => {
            console.log('Web Development clicked!')
        }
    }
]

</script>

<template>
    <AppLayout title="Services">
        <ServiceHeader/>
        <div class="mx-auto gap-8 max-w-5xl flex flex-row flex-wrap justify-center place-content-center m-4">
            <ServiceCard
                v-for="(card, index) in cards"
                :key="index"
                :features="card.features" :on-learn-more="card.onLearnMore" :price="card.price"
                :prime-icon="card.primeIcon" :subtitle="card.subtitle" :title="card.title"/>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
