<script setup lang="ts">
import InspireCard from "@/Components/Custom/InspireCard.vue";
import {InspireCardData} from "@/Types/InspireCardData";

const {t} = useI18n()

const cards: InspireCardData[] = [
    {
        //history
        title: t('about-us.cards.1.title'),
        subtitle: t('about-us.cards.1.subtitle'),
        onClick: () => handleVisibleState('history'),
        images: [
            {
                src: "https://merotto.it/app/uploads/2024/04/P007_video2-placeholder-low.jpg",
                alt: t('about-us.cards.1.image-alt')
            }
        ]
    },
    {
        //mission
        title: t('about-us.cards.2.title'),
        subtitle: t('about-us.cards.2.subtitle'),
        onClick: () => handleVisibleState('mission'),
        images: [
            {
                src: "https://www.pensionati.cna.it/wp-content/uploads/2024/01/AdobeStock_603073451_w.jpg",
                alt: t('about-us.cards.2.image-alt')
            }
        ]
    },
];
const contentRef = ref<HTMLElement | null>(null);

function handleVisibleState(from: 'history' | 'mission'): void {
    visibleState.value === from ? visibleState.value = 'none' : visibleState.value = from;
    nextTick(() => {
        if (visibleState.value !== 'none' && contentRef.value) {
            contentRef.value.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
}

const visibleState = ref<'none' | 'history' | 'mission'>('none');
</script>

<template>
    <div class="mx-auto gap-8 max-w-5xl flex flex-row flex-wrap justify-center place-content-center m-4 my-6">
        <InspireCard class="max-w-xs" v-for="card in cards" :card="card"/>
    </div>
    <!-- Transizione -->
    <Transition
        enter-active-class="transition duration-500 ease-out"
        enter-from-class="opacity-0 translate-y-4"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition duration-300 ease-in"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 translate-y-4"
    >
        <div v-show="visibleState !== 'none'" ref="contentRef" key="content"
             class="text-center space-y-4 px-4 mb-20 h-50">
            <div v-if="visibleState === 'history'">
                <h2 class="text-3xl font-bold">{{ t('about-us.cards.history.title') }}</h2>
                <h3 class="text-xl font-semibold">{{ t('about-us.cards.history.subtitle') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ t('about-us.cards.history.paragraph1') }}
                </p>
                <p class="text-gray-600 leading-relaxed">
                    {{ t('about-us.cards.history.paragraph2') }}
                </p>
            </div>

            <div v-else-if="visibleState === 'mission'">
                <h2 class="text-3xl font-bold">{{ t('about-us.cards.mission.title') }}</h2>
                <h3 class="text-xl font-semibold">{{ t('about-us.cards.mission.subtitle') }}</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ t('about-us.cards.mission.paragraph') }}
                </p>
            </div>
        </div>
    </Transition>
</template>

<style scoped>

</style>
