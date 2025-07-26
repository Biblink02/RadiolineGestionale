<script setup lang="ts">

const props = withDefaults(
    defineProps<{
        src: string
        alt: string
        withoutText?: boolean
    }>(),
    {
        withoutText: false
    }
)

</script>

<template>
    <div class="max-w-7xl mx-auto relative">
        <img
            :src="props.src"
            :alt="props.alt"
            class="w-full h-64 object-cover rounded-lg"
        />
        <div v-if="!props.withoutText" class="absolute inset-0 flex items-center justify-center">
            <h1 class="text-3xl md:text-5xl font-bold text-white drop-shadow-lg">
                Medjugorje SERVICE
            </h1>
        </div>
    </div>
</template>

<style scoped>

</style>
