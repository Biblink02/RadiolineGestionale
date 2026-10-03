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
let ticking = false;

const updateScrollTopState = () => {
    const top = window.scrollY || document.documentElement.scrollTop || 0;
    visible.value = top > props.threshold;
};

const onScroll = () => {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
        updateScrollTopState();
        ticking = false;
    });
};

useEventListener(window, 'scroll', onScroll, { passive: true });

onMounted(updateScrollTopState);

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: props.behavior
    });
}
</script>

<template>
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
