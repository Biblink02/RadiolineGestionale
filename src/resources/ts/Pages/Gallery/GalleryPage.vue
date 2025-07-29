<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";

const {t} = useI18n();
const images = [
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",
    "https://www.cobraspa.it/upload/img/c/1000x0-x%20OMG-100-1_rev%20(Omero%20101)%20copia_quadrato%20per%20sito.jpg",

]
</script>

<template>
    <AppLayout :title="t('gallery.title')">
        <h1 class="text-3xl font-bold mb-8 text-center">Mosaico Fotografico</h1>

        <div class="grid grid-cols-6 gap-4 auto-rows-[150px]">
            <div
                v-for="(img, index) in images"
                :key="index"
                :class="[
                    'relative group rounded-xl overflow-hidden shadow-lg transition-all duration-300',
                    index % 7 === 0 ? 'col-span-3 row-span-2' :
                    index % 5 === 0 ? 'col-span-2 row-span-2' :
                    'col-span-2 row-span-1'
                ]"
            >
                <Image
                    :src="img"
                    preview
                    alt="foto"
                    class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500"
                />
                <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center text-white text-lg font-semibold">
                    Clicca per ingrandire
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
