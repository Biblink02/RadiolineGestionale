<script setup lang="ts">
const props = defineProps<{
    iconSize?: number
    containerClass?: string
}>();
const socials = [
    {label: "Facebook", href: "https://www.facebook.com/medjugorjeservice", icon: "pi pi-facebook"},
    {label: "Instagram", href: "https://www.instagram.com", icon: "pi pi-instagram"},
];
const fontSize = computed(() => (props.iconSize ?? 1.5) + 'rem');
</script>

<template>
    <div :class="props.containerClass">
        <a v-for="social in socials" :href="social.href" target="_blank"
           class="text-slate-500 hover:text-blue-600 transition-colors" :aria-label="social.label">
            <span class="sr-only">{{ social.label }}</span>
            <i :class="social.icon" :style="{ fontSize: fontSize }"></i>
        </a>
    </div>
</template>

<style scoped>

</style>
