<script setup lang="ts">
import Home2 from "@/../media/2-home.jpg";
import Home3 from "@/../media/3-home.jpeg";
import Home4 from "@/../media/4-home.jpeg";
import {route} from "../../../../vendor/tightenco/ziggy";
import {InspireCardData} from "@/Types/InspireCardData";
import InspireCardLink from "@/Components/Custom/InspireCardLink.vue";
import InspireCard from "@/Components/Custom/InspireCard.vue";
import {Link} from "@inertiajs/vue3";

const {t} = useI18n()
const page = usePage()

const cards = [
    {
        title: t('home.inspire.cards.1.title'),
        text: t('home.inspire.cards.1.button'),
        href: route('page.radio-rent', {locale: page.props.locale}, false),
        imageSrc: Home2,
        imageAlt: t('home.inspire.cards.1.images.1.alt')
    },
    {
        title: t('home.inspire.cards.2.title'),
        text: t('home.inspire.cards.2.button'),
        href: route('page.proposals', {locale: page.props.locale}, false),
        imageSrc: Home3,
        imageAlt: t('home.inspire.cards.2.images.1.alt')
    },
    {
        title: t('home.inspire.cards.3.title'),
        text: t('home.inspire.cards.3.button'),
        href: route('page.jubilee-2025', {locale: page.props.locale}, false),
        imageSrc: Home4,
        imageAlt: t('home.inspire.cards.3.images.1.alt')
    }
];

</script>

<template>
    <section class="section mt-2 mb-10 sm:my-10">
        <h2 class="text-center text-3xl font-bold">{{ t('home.inspire.title') }}</h2>
        <div class="mx-auto gap-8 max-w-5xl flex flex-row flex-wrap justify-center place-content-center m-4 mt-6">
            <InspireCard class="max-w-xs" v-for="card in cards" :card="card">
                <Link class="group/button mt-auto mx-auto flex items-center gap-1 text-slate-500 hover:text-blue-600 transition-colors hover:cursor-pointer"
                      :href="card.href"
                >
                    {{ card.text }}
                    <i class="pi pi-arrow-right text-xs transition-transform duration-300 group-hover/button:translate-x-1"></i>
                </Link>
            </InspireCard>
        </div>
    </section>
</template>

<style scoped>

</style>
