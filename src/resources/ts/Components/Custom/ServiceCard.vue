<script setup lang="ts">
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'

const hovering = ref(false)

const props = defineProps<{
    title: string
    subtitle: string
    price: string
    features: string[]
    primeIcon: string
    onLearnMore: () => void
}>()

const { t } = useI18n()
</script>

<template>
    <article
        @mouseover="hovering = true"
        @mouseleave="hovering = false"
        class="transition-all duration-300 p-6 rounded-xl border border-white bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 group max-w-sm"
        :aria-label="props.title"
    >
        <div
            class="mx-auto mb-4 w-14 h-14 rounded-full flex items-center justify-center transition-all duration-300"
            :class="hovering ? 'bg-blue-600' : 'bg-blue-100'"
        >
            <i
                class="text-2xl transition-colors duration-300"
                :class="['pi', props.primeIcon, hovering ? 'text-white' : 'text-blue-800']"
                aria-hidden="true"
            />
        </div>

        <h2 class="text-xl font-semibold text-center text-black mb-1">
            {{ props.title }}
        </h2>

        <p class="text-sm text-center text-gray-500 mb-4">
            {{ props.subtitle }}
        </p>

        <p class="text-center text-blue-800 text-2xl font-bold mb-4" :aria-label="t('service_card.aria_price')">
            {{ props.price }}
            <span class="text-base font-medium text-gray-500">/ {{ t('service_card.per_radio') }}</span>
        </p>

        <ul class="text-sm text-gray-700 space-y-2 mb-6" :aria-label="t('service_card.aria_features')">
            <li
                v-for="(item, index) in props.features"
                :key="index"
                class="flex items-start"
            >
                <span class="w-2 h-2 mt-2 mr-2 bg-blue-800 rounded-full" aria-hidden="true"></span>
                <span>{{ item }}</span>
            </li>
        </ul>

        <button
            type="button"
            class="group/button hover:cursor-pointer inline-flex justify-center items-center w-full px-5 py-2 border border-blue-800 text-blue-800 font-medium rounded-lg transition-all duration-300 hover:bg-blue-600 hover:text-white"
            @click="props.onLearnMore"
            :aria-label="t('service_card.aria_learn')"
        >
            {{ t('service_card.learn_more') }}
            <i
                class="pi pi-arrow-right ml-2 transition-transform duration-300 group-hover/button:translate-x-1"
                aria-hidden="true"
            />
        </button>
    </article>
</template>

<style scoped>
</style>
