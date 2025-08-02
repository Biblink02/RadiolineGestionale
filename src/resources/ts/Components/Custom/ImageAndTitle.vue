<script setup lang="ts">

const props = defineProps<{
    src: string
    alt: string
    text?: string
    imageClass?: string
}>()


</script>

<template>
    <div class="max-w-7xl mx-auto relative">
        <div class="px-2 mt-4">
            <img
                :src="props.src"
                :alt="props.alt"
                class="w-full h-100 object-cover rounded-lg" :class="imageClass"
            />
        </div>
        <div v-if="props.text" class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-3xl md:text-5xl font-bold text-white drop-shadow-lg">
                {{ props.text }}
            </h1>
        </div>
    </div>
</template>

<style scoped>

</style>
