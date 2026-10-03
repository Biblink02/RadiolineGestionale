<script setup lang="ts">
interface Props {
    threshold?: number;
    behavior?: ScrollBehavior;
}

const props = withDefaults(defineProps<Props>(), {
    threshold: 400,
    behavior: 'smooth'
});

const visible = ref(false);
const sentinelRef = ref<HTMLElement | null>(null);
let observer: IntersectionObserver | null = null;

onMounted(async () => {
    await nextTick();
    if (sentinelRef.value) {
        observer = new IntersectionObserver(
            ([entry]) => {
                visible.value = !entry.isIntersecting;
            },
            { threshold: 0 }
        );
        observer.observe(sentinelRef.value);
    }
});

onUnmounted(() => {
    observer?.disconnect();
    observer = null;
});

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: props.behavior
    });
}
</script>

<template>
    <div
        ref="sentinelRef"
        class="absolute top-0 left-0 w-full pointer-events-none -z-50"
        :style="{ height: `${props.threshold}px` }"
        aria-hidden="true"
    ></div>
    <Transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0 translate-y-4 scale-90"
        enter-to-class="opacity-100 translate-y-0 scale-100"
        leave-active-class="transition duration-150 ease-in"
        leave-from-class="opacity-100 translate-y-0 scale-100"
        leave-to-class="opacity-0 translate-y-4 scale-90"
    >
        <button
            v-show="visible"
            type="button"
            class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-10 h-10 rounded-full shadow-lg text-white cursor-pointer focus:outline-none transition-transform active:scale-95"
            style="background: var(--color-primary);"
            aria-label="Scroll to top"
            @click="scrollToTop"
        >
            <i class="pi pi-chevron-up text-sm"></i>
        </button>
    </Transition>
</template>
