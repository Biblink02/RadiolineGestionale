<script setup lang="ts">

import AppLayout from "@/Layouts/AppLayout.vue";

const {t} = useI18n();
</script>

<template>
    <AppLayout :title="t('payments.title')">
        <section class="max-w-4xl mx-auto py-12 px-4">
            <!-- Titolo -->
            <h1 class="text-3xl font-bold text-center mb-6">
                {{ t('payments.header.title') }}
            </h1>

            <!-- Testo -->
            <h2 class="text-gray-700 font-semibold mb-6">
                {{ t('payments.header.description') }}
            </h2>

            <!-- Metodi di pagamento -->
            <ol class="list-decimal list-inside space-y-2 text-gray-700">
                <li>{{ t('payments.methods.bank') }}</li>
                <li>{{ t('payments.methods.cash') }}</li>
            </ol>
        </section>
    </AppLayout>
</template>

<style scoped>

</style>
