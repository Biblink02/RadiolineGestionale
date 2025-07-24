<script setup lang="ts">
import {InspireCardData} from "@/Types/InspireCardData";

const props = defineProps<{
    card: InspireCardData;
}>();
</script>

<template>
    <article
        class="transition-all duration-300 rounded-xl border border-white bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 group overflow-hidden"
        :aria-label="props.card.title"
    >
        <!-- Galleria PrimeVue -->
        <Galleria
            :value="props.card.images"
            :responsiveOptions="[]"
            :showThumbnails="false"
            :showIndicators="false"
            :circular="true"
            :autoPlay="true"
            :transitionInterval="3000"
            :numVisible="1"
            containerClass="h-64 w-full"
        >
            <template #item="slotProps">
                <img
                    :src="slotProps.item.src"
                    :alt="slotProps.item.alt"
                    class="object-cover"
                />
            </template>
        </Galleria>

        <!-- Contenuto -->
        <div class="p-6 text-center">
            <h2 class="text-xl font-semibold text-black mb-2">
                {{ props.card.title }}
            </h2>

            <button
                class="group/button mx-auto flex items-center gap-1 text-slate-500 hover:text-blue-600 transition-colors hover:cursor-pointer"
                @click="props.card.onClick"
            >
                {{ props.card.subtitle }}
                <i class="pi pi-arrow-right text-xs transition-transform duration-300 group-hover/button:translate-x-1"></i>
            </button>
        </div>
    </article>
</template>

<style scoped>
:deep(.p-galleria) {
    border: none !important;
    box-shadow: none !important;
}
</style>
