<script setup lang="ts">
import SocialPart from "@/Components/Custom/SocialPart.vue";
import {route} from "../../../vendor/tightenco/ziggy";
import {Link} from "@inertiajs/vue3"

const {t} = useI18n();

const links = [
    {label: t("footer.links.label1"), href: route('page.about-us', undefined, false)},
    {label: t("footer.links.label2"), href: route('page.contact-us', undefined, false)},
    {label: t("footer.links.label3"), href: route('page.offices', undefined, false)},
    {label: t("footer.links.label4"), href: route('page.privacy', undefined, false)},
    {label: t("footer.links.label5"), href: route('page.payments', undefined, false)},
];
const phoneWhatsApp = ref("00387063144027");
const email = ref("medjugorjeservice00@gmail.com");

function formattedPhone(raw: string) {
    const match = raw.match(/^00(\d{3})(\d{3})(\d{3})(\d{3})$/);
    if (match) {
        return `+${match[1]} ${match[2]} ${match[3]} ${match[4]}`;
    }
    return raw;
}
</script>

<template>
    <footer class="bg-blue-900 border-t border-slate-200 text-white w-full mx-auto pb-10">
        <div class="max-w-7xl mx-auto">
            <div class="mx-auto gap-8 flex flex-wrap justify-between items-center p-6">

                <!-- LINKS -->
                <div
                    class="flex flex-wrap gap-4 text-sm justify-center sm:justify-start"
                >
                    <Link
                        v-for="(link, index) in links"
                        :key="index"
                        :href="link.href"
                        class="hover:text-blue-600 transition-colors"
                    >
                        {{ link.label }}
                    </Link>
                </div>

                <!-- SOCIAL -->
                <div
                    class="flex gap-4 justify-center sm:justify-end mt-4 sm:mt-0 mx-auto sm:mx-0"
                >
                    <SocialPart a-class="text-white hover:text-blue-600" container-class="space-x-6"/>
                </div>
            </div>

            <div class="text-xs w-full mx-auto px-4">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-x-4">
                    <!-- Links a sinistra -->
                    <div
                        class="flex flex-col gap-y-1 text-center sm:text-left sm:flex-row sm:flex-wrap sm:gap-4">

                        <!-- Address -->
                        <a href="https://maps.app.goo.gl/sTaZTrP1WC7cu5y99" target="_blank" rel="noreferrer"
                           class="hover:text-blue-600 transition-colors">
                            Pape Ivana Pavla II 14 88266 Medjugorje
                        </a>
                        <span class="hidden sm:inline">|</span>


                        <!-- Tel -->
                        <a :href="`tel:${phoneWhatsApp}`" class="hover:text-blue-600 transition-colors">
                            <span class="text-xs mr-1">Tel.</span>
                            {{ formattedPhone(phoneWhatsApp) }}
                        </a>

                        <span class="hidden sm:inline">|</span>

                        <!-- Alt
                        <a :href="`tel:${phoneAlt}`" class="hover:text-blue-600 transition-colors">
                            {{ formattedPhone(phoneAlt) }}
                            <span class="text-xs ml-1">(Alt.)</span>
                        </a>
                        <span class="hidden sm:inline">|</span>
                        -->

                        <!-- Email -->
                        <a :href="`mailto:${email}`" class="hover:text-blue-600 transition-colors break-all">
                            <span class="text-xs mr-1">Mail:</span>

                            {{ email }}
                        </a>

                    </div>

                    <!-- Copyright a destra -->
                    <div class="text-center sm:text-right">
                        Copyright © 2025 Medjugorje Service
                    </div>
                </div>
            </div>

        </div>

    </footer>
</template>
