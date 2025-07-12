<script setup lang="ts">
const { t } = useI18n()
</script>

<template>
    <section
        class="relative flex min-h-[90vh] items-center justify-center bg-cover bg-fixed bg-center text-white"
        :aria-label="t('homepage.hero.aria')"
        role="region"
        style='background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), url("https://lh3.googleusercontent.com/aida-public/AB6AXuDT21lW4TzKjqODPMf6cywfDZQYabjG_ImOqRD3JErg1ioVl1VVylZvmqpr1C3NDjHTrOPGLExyZU9gSF9ltUmQ1nhcO18kBLuQKQlMx1XvY-Z5I9QXT5jfSzpn-fNHlGWtqvCj30gpY15Mw6nPvE0D7_ZHuZVo9MHJfGoj5GayYk2KMDgFNHkifUvnmoOGEddwGDIP7T0w2mPFpCZpaGR5F9hYZ_EZNZIQuRtHahaxMJxY4R4dZZCaFR8iLuH22B7RwjCbinT18H4z");'
    >
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold md:text-6xl">
                {{ t('homepage.hero.title') }}
                <span class="sr-only">{{ t('homepage.hero.title_sr') }}</span>
            </h1>

            <p class="mt-4 max-w-2xl mx-auto text-lg text-gray-200 mt-6">
                {{ t('homepage.hero.subtitle') }}
            </p>

            <a
                href="/services"
                class="mt-8 inline-block rounded-md bg-blue-800 px-8 py-3 text-lg font-semibold text-white shadow-lg transition-transform hover:scale-105 hover:bg-blue-600"
                :aria-label="t('homepage.hero.cta_aria')"
            >
                {{ t('homepage.hero.cta') }}
            </a>
        </div>
    </section>
</template>


<style scoped>

</style>
