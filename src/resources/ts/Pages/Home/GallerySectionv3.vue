<script setup lang="ts">

const { t } = useI18n();

const images = ref([
    {
        itemImageSrc: 'https://www.operaromanapellegrinaggi.org/uploads/slideshow_item/mobile_image/1402/MDJGR-0-TESTATA-MOBILE-435x465.jpg',
        thumbnailImageSrc: 'https://www.operaromanapellegrinaggi.org/uploads/slideshow_item/mobile_image/1402/MDJGR-0-TESTATA-MOBILE-435x465.jpg',
        alt: t('homepage.gallery.image1.alt')
    },
    {
        itemImageSrc: 'https://rusconiviaggi.it/wp-content/uploads/2024/07/Pellegrinaggio-a-Medjugorje-da-Verona_Rusconi-Viaggi-e-Pellegrinaggi.jpg',
        thumbnailImageSrc: 'https://rusconiviaggi.it/wp-content/uploads/2024/07/Pellegrinaggio-a-Medjugorje-da-Verona_Rusconi-Viaggi-e-Pellegrinaggi.jpg',
        alt: t('homepage.gallery.image2.alt')
    },
    {
        itemImageSrc: 'https://www.madonnadellabozzola.org/wp-content/uploads/2024/04/Medjugorje-24-scaled.jpg',
        thumbnailImageSrc: 'https://www.madonnadellabozzola.org/wp-content/uploads/2024/04/Medjugorje-24-scaled.jpg',
        alt: t('homepage.gallery.image3.alt')
    },
    {
        itemImageSrc: 'https://rusconiviaggi.it/wp-content/uploads/2024/07/Pellegrinaggio-a-Medjugorje-da-Verona_Rusconi-Viaggi-e-Pellegrinaggi.jpg',
        thumbnailImageSrc: 'https://rusconiviaggi.it/wp-content/uploads/2024/07/Pellegrinaggio-a-Medjugorje-da-Verona_Rusconi-Viaggi-e-Pellegrinaggi.jpg',
        alt: t('homepage.gallery.image4.alt')
    },
    {
        itemImageSrc: 'https://www.madonnadellabozzola.org/wp-content/uploads/2024/04/Medjugorje-24-scaled.jpg',
        thumbnailImageSrc: 'https://www.madonnadellabozzola.org/wp-content/uploads/2024/04/Medjugorje-24-scaled.jpg',
        alt: t('homepage.gallery.image3.alt')
    },
    {
        itemImageSrc: 'https://rusconiviaggi.it/wp-content/uploads/2024/07/Pellegrinaggio-a-Medjugorje-da-Verona_Rusconi-Viaggi-e-Pellegrinaggi.jpg',
        thumbnailImageSrc: 'https://rusconiviaggi.it/wp-content/uploads/2024/07/Pellegrinaggio-a-Medjugorje-da-Verona_Rusconi-Viaggi-e-Pellegrinaggi.jpg',
        alt: t('homepage.gallery.image2.alt')
    },
    {
        itemImageSrc: 'https://www.madonnadellabozzola.org/wp-content/uploads/2024/04/Medjugorje-24-scaled.jpg',
        thumbnailImageSrc: 'https://www.madonnadellabozzola.org/wp-content/uploads/2024/04/Medjugorje-24-scaled.jpg',
        alt: t('homepage.gallery.image3.alt')
    },
]);

const responsiveOptions = ref([
    {
        breakpoint: '1024px',
        numVisible: 5
    },
    {
        breakpoint: '768px',
        numVisible: 3
    },
    {
        breakpoint: '560px',
        numVisible: 1
    }
]);
</script>

<template>
    <section class="py-12 bg-gray-100">
        <div class="max-w-5xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Galleria di Medjugorje</h2>
            <Galleria
                :showThumbnailNavigators="true"
                :showItemNavigatorsOnHover="true"
                :value="images"
                :responsiveOptions="responsiveOptions"
                :numVisible="4"
                :autoplay="true"
                :circular="true"
                :transitionInterval="2000"
                containerStyle="max-width: 900px; margin: 0 auto"
            >
                <template #item="slotProps">
                    <img
                        :src="slotProps.item.itemImageSrc"
                        :alt="slotProps.item.alt"
                        class="w-full h-96 object-cover rounded-lg shadow-lg"
                    />
                </template>
                <template #thumbnail="slotProps">
                    <img
                        :src="slotProps.item.thumbnailImageSrc"
                        :alt="slotProps.item.alt"
                        class="w-20 h-20 object-cover rounded-md"
                    />
                </template>
            </Galleria>
        </div>
    </section>
</template>

<style scoped>
.p-disable{

}
</style>
