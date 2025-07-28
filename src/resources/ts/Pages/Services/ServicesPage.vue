<script setup>
import { HugeiconsIcon } from '@hugeicons/vue';
import {AirplaneModeIcon, CargoShipIcon, House01Icon, MentoringIcon, VisionIcon} from "@hugeicons/core-free-icons";
import AppLayout from "@/Layouts/AppLayout.vue";

const { t } = useI18n()

const services = reactive([
    {
        title: t('services.airportTransfers.title'),
        icon: AirplaneModeIcon,
        elements: [
            t('services.airportTransfers.element1'), // Sarajevo
            t('services.airportTransfers.element2'), // Mostar
            t('services.airportTransfers.element3'), // Dubrovnik
            t('services.airportTransfers.element4'), // Spalato
            t('services.airportTransfers.element5'), // Zara
            t('services.airportTransfers.element6')  // Venezia
        ]
    },
    {
        title: t('services.portTransfers.title'),
        icon: CargoShipIcon,
        elements: [
            t('services.portTransfers.element1'), // Dubrovnik
            t('services.portTransfers.element2')  // Spalato
        ]
    },
    {
        title: t('services.accommodation.title'),
        icon: House01Icon,
        elements: [
            t('services.accommodation.element1'), // Pensione famigliare
            t('services.accommodation.element2'), // Hotel 3 stelle
            t('services.accommodation.element3'), // Hotel 4 stelle
            t('services.accommodation.element4')  // Hotel 4 stelle S
        ]
    },
    {
        title: t('services.guide.title'),
        icon: MentoringIcon,
        elements: [
            t('services.guide.element1') // Locale
        ]
    },
    {
        title: t('services.guidedTours.title'),
        icon: VisionIcon,
        elements: [
            t('services.guidedTours.element1'), // Sarajevo
            t('services.guidedTours.element2'), // Mostar
            t('services.guidedTours.element3'), // Tkalina
            t('services.guidedTours.element4'), // Surmanci
            t('services.guidedTours.element5')  // Dubrovnik
        ]
    },
])
const openPanels = ref(services.map((_, index) => index))

</script>

<template>
    <AppLayout :title="t('services.title')">
        <div class="container mx-auto p-6 max-w-7xl">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">{{ t('services.specification') }}</h1>

            <Accordion  class="bg-white shadow rounded-lg" v-model:value="openPanels" multiple>
                <AccordionPanel
                    v-for="(service, key) in services"
                    :key="key"
                    :value="key"
                >
                    <AccordionHeader>
                        <div class="text-left">
                            <HugeiconsIcon :icon="service.icon" class="w-5 h-5 inline-block mr-2 text-blue-800"/>
                            {{ service.title }}
                        </div>
                    </AccordionHeader>
                    <AccordionContent>
                        <ul class="list-disc list-inside space-y-1 mt-2">
                            <li v-for="(item, idx) in service.elements" :key="idx">{{ item }}</li>
                        </ul>
                    </AccordionContent>
                </AccordionPanel>
            </Accordion>
        </div>
    </AppLayout>
</template>
