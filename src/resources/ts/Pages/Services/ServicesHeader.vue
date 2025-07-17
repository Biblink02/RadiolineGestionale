<script setup lang="ts">
const { t } = useI18n()
</script>

<template>
    <section aria-labelledby="services-header-title" class="container mx-auto px-6 my-6">
        <div class="max-w-4xl mx-auto text-center">
            <h1 id="services-header-title" class="text-3xl font-bold md:text-4xl">
                {{ t('services.header.title') }}
                <span class="sr-only">{{ t('services.header.title_sr') }}</span>
            </h1>

            <p class="mt-4 text-lg">
                {{ t('services.header.description') }}
            </p>
        </div>
    </section>
</template>

<style scoped></style>
