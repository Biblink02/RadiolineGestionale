<script setup lang="ts">
const {t} = useI18n();

</script>


<template>
    <div class="container mx-auto px-6 my-6">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-3xl font-bold text-[var(--text-primary)] md:text-4xl">
                {{ t('services.about.title') }}
                <span class="sr-only">{{ t('services.about.title_sr') }}</span>
            </h1>

            <p class="mt-4 text-lg text-[var(--text-secondary)]">
                {{ t('services.about.description') }}
            </p>
        </div>
    </div>
</template>

<style scoped>

</style>
