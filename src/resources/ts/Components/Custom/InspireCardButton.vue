<script setup lang="ts">
import {InspireCardData} from "@/Types/InspireCardData";

const props = defineProps<{
    card: InspireCardData;
}>();
</script>

<template>
    <article
        class="transition-all duration-300 rounded-xl border border-white bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 group overflow-hidden flex flex-col"
        :aria-label="props.card.title"
    >
        <!-- Immagine -->
        <div class="w-full h-60 md:h-70 overflow-hidden">
            <img
                :src="props.card.imageSrc"
                :alt="props.card.imageAlt"
                class="w-full h-full object-cover"
            />
        </div>

        <!-- Contenuto con bottone in fondo -->
        <div class="p-4 text-center flex flex-col flex-1">
            <div>
                <h2 v-if="props.card.title" class="text-xl font-semibold text-black mb-2">
                    {{ props.card.title }}
                </h2>
                <p v-if="props.card.subtitle" class="mb-2">
                    {{ props.card.subtitle }}
                </p>
            </div>

            <button v-if="props.card.buttonOrLink"
                    class="group/button mt-auto mx-auto flex items-center gap-1 text-slate-500 hover:text-blue-600 transition-colors hover:cursor-pointer"
                    @click="props.card.onClick"
            >
                {{ props.card.buttonOrLink }}
                <i class="pi pi-arrow-right text-xs transition-transform duration-300 group-hover/button:translate-x-1"></i>
            </button>
        </div>
    </article>
</template>


<style scoped>

</style>
