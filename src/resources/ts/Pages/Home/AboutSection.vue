<script setup lang="ts">
const {t} = useI18n();
</script>

<template>
    <section
        id="about"
        class="py-20 bg-[var(--secondary-color)]"
        :aria-label="t('homepage.about.aria')"
        role="region"
    >
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-[var(--text-primary)] md:text-4xl">
                    {{ t('homepage.about.title') }}
                    <span class="sr-only">{{ t('homepage.about.title_sr') }}</span>
                </h2>

                <p class="mt-4 text-lg text-[var(--text-secondary)]">
                    {{ t('homepage.about.description') }}
                </p>
            </div>

            <div class="card flex flex-col items-center overflow-hidden mt-20">
                <div class="flex flex-wrap justify-center gap-8">

                    <!-- Card 1 -->
                    <div
                        v-animateonscroll="{ enterClass: 'animate-enter fade-in-10 slide-in-from-l-8 animate-duration-1000', leaveClass: 'animate-leave fade-out-0' }"
                        class="flex flex-col border border-surface shadow-lg justify-center items-center max-w-80 rounded-2xl p-8 gap-4"
                        :aria-label="t('homepage.about.cards.individual.aria')"
                        role="group"
                    >
                        <div
                            class="rounded-full bg-primary text-primary-contrast w-12 h-12 flex items-center justify-center">
                            <i class="pi pi-user !text-2xl" aria-hidden="true"></i>
                        </div>
                        <span class="text-2xl font-bold">
              {{ t('homepage.about.cards.individual.title') }}
            </span>
                        <span class="text-muted-color text-center">
              {{ t('homepage.about.cards.individual.description') }}
            </span>
                    </div>

                    <!-- Card 2 -->
                    <div
                        v-animateonscroll="{ enterClass: 'animate-enter fade-in-10 animate-duration-1000', leaveClass: 'animate-leave fade-out-0' }"
                        class="flex flex-col border border-surface shadow-lg justify-center items-center max-w-80 rounded-2xl p-8 gap-4"
                        :aria-label="t('homepage.about.cards.team.aria')"
                        role="group"
                    >
                        <div
                            class="rounded-full bg-primary text-primary-contrast w-12 h-12 flex items-center justify-center">
                            <i class="pi pi-users !text-2xl" aria-hidden="true"></i>
                        </div>
                        <span class="text-2xl font-bold">
              {{ t('homepage.about.cards.team.title') }}
            </span>
                        <span class="text-muted-color text-center">
              {{ t('homepage.about.cards.team.description') }}
            </span>
                    </div>

                    <!-- Card 3 -->
                    <div
                        v-animateonscroll="{ enterClass: 'animate-enter fade-in-10 slide-in-from-r-8 animate-duration-1000', leaveClass: 'animate-leave fade-out-0' }"
                        class="flex flex-col border border-surface shadow-lg justify-center items-center max-w-80 rounded-2xl p-8 gap-4"
                        :aria-label="t('homepage.about.cards.enterprise.aria')"
                        role="group"
                    >
                        <div
                            class="rounded-full bg-primary text-primary-contrast w-12 h-12 flex items-center justify-center">
                            <i class="pi pi-building !text-2xl" aria-hidden="true"></i>
                        </div>
                        <span class="text-2xl font-bold">
              {{ t('homepage.about.cards.enterprise.title') }}
            </span>
                        <span class="text-muted-color text-center">
              {{ t('homepage.about.cards.enterprise.description') }}
            </span>
                    </div>

                </div>
            </div>
        </div>
    </section>
</template>


<style scoped>

</style>
