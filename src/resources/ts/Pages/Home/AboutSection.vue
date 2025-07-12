<script setup lang="ts">
const events = ref([
    {
        status: 'temp1',
        date: '2024 - Present',
        color: 'blue',
        image: "https://media.vaticannews.va/media/content/dam-archive/vaticannews/images-multimedia/chiesa/MedjugorjeAEM.jpg/_jcr_content/renditions/cq5dam.thumbnail.cropped.1500.844.jpeg",
        description:
            "temp description",
        icon: 'pi pi-graduation-cap',
    },
])
</script>

<template>

    <section class="py-20 bg-[var(--secondary-color)]" id="about">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-[var(--text-primary)] md:text-4xl">About Us</h2>
                <p class="mt-4 text-lg text-[var(--text-secondary)]">
                    At Pilgrimage Support, we are dedicated to facilitating meaningful pilgrimages to Medjugorje.
                    Our team of experienced professionals handles all logistical and technical aspects, allowing
                    you to focus on your spiritual journey. We are committed to providing personalized support and
                    ensuring a safe, comfortable, and transformative experience for every pilgrim.
                </p>
            </div>

            <div class="card flex flex-col items-center overflow-hidden mt-20">
                <div class="flex flex-wrap justify-center gap-8">
                    <div
                        v-animateonscroll="{ enterClass: 'animate-enter fade-in-10 slide-in-from-l-8 animate-duration-1000', leaveClass: 'animate-leave fade-out-0' }"
                        class="flex flex-col border border-surface shadow-lg justify-center items-center max-w-80 rounded-2xl p-8 gap-4"
                    >
                        <div class="rounded-full bg-primary text-primary-contrast w-12 h-12 flex items-center justify-center">
                            <i class="pi pi-user !text-2xl"></i>
                        </div>
                        <span class="text-2xl font-bold">Individual</span>
                        <span class="text-muted-color text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                    </div>
                    <div
                        v-animateonscroll="{ enterClass: 'animate-enter fade-in-10 animate-duration-1000', leaveClass: 'animate-leave fade-out-0' }"
                        class="flex flex-col border border-surface shadow-lg justify-center items-center max-w-80 rounded-2xl p-8 gap-4"
                    >
                        <div class="rounded-full bg-primary text-primary-contrast w-12 h-12 flex items-center justify-center">
                            <i class="pi pi-users !text-2xl"></i>
                        </div>
                        <span class="text-2xl font-bold">Team</span>
                        <span class="text-muted-color text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                    </div>
                    <div
                        v-animateonscroll="{ enterClass: 'animate-enter fade-in-10 slide-in-from-r-8 animate-duration-1000', leaveClass: 'animate-leave fade-out-0' }"
                        class="flex flex-col border border-surface shadow-lg justify-center items-center max-w-80 rounded-2xl p-8 gap-4"
                    >
                        <div class="rounded-full bg-primary text-primary-contrast w-12 h-12 flex items-center justify-center">
                            <i class="pi pi-building !text-2xl"></i>
                        </div>
                        <span class="text-2xl font-bold">Enterprise</span>
                        <span class="text-muted-color text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.</span>
                    </div>
                </div>
            </div>
        </div>

    </section>
</template>

<style scoped>

</style>
