<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import {breakpointsTailwind} from "@vueuse/core";

const {t} = useI18n();
const props = defineProps<{
    imgNumber: number;
    batchSize: number;
}>()
const allImages = Array.from({length: props.imgNumber}, (_, i) => ({
    src: `/images/gallery/gallery${i}.webp`,
}));

const batch = ref(1);
const loadedImages = computed(() => allImages.slice(0, props.batchSize * batch.value))

const stopScroll = useEventListener(window, 'scroll', () => {
    const threshold = Math.min(0.4 + (batch.value - 1) * 0.1, 0.7);

    if (props.imgNumber <= props.batchSize * batch.value) {
        stopScroll();
    } else if (window.innerHeight + window.scrollY >= document.body.offsetHeight * threshold) {
        batch.value++;
    }
});
const breakpoints = useBreakpoints(breakpointsTailwind);
const gap = computed(() => {
    if (breakpoints.smaller("sm").value) return 20;
    if (breakpoints.between("sm", "md").value) return 30;
    if (breakpoints.between("md", "lg").value) return 40;
    if (breakpoints.between("lg", "xl").value) return 50;
    if (breakpoints.greaterOrEqual("xl").value) return 60;
    return 40;
});
const imageAlt = t('gallery.body.image-alt');
const previewAlt = t('gallery.body.preview-alt')
</script>

<template>
    <AppLayout :title="t('gallery.title')">
        <h1 class="text-center text-bold text-4xl mt-9">{{ t('gallery.body.title') }}</h1>
        <masonry-wall
            :items="loadedImages"
            :ssr-columns="1"
            :min-columns="1"
            :max-columns="3"
            :column-width="300"
            :gap="gap"
            class="m-4 sm:m-8 md:m-12 lg:m-20"
        >
            <template #default="{ item, index }">
                <div class="transition-transform duration-300 hover:scale-105 rounded shadow-md overflow-hidden">
                    <Image :alt="imageAlt" preview class="w-full h-auto rounded-lg shadow-md">
                        <template #image>
                            <img
                                :src="item.src"
                                :alt="imageAlt + ' ' + index"
                            />
                        </template>
                        <template #preview="slotProps">
                            <img
                                class="max-w-[70%]! max-h-[70%]! m-auto!"
                                :src="item.src"
                                :alt="previewAlt + ' ' + index"
                                :style="slotProps.style" @click="slotProps.onClick"
                            />
                        </template>
                    </Image>
                </div>
            </template>
        </masonry-wall>
    </AppLayout>
</template>
