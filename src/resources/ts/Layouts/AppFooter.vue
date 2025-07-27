<script setup lang="ts">
import SocialPart from "@/Components/Custom/SocialPart.vue";
import {route} from "../../../vendor/tightenco/ziggy";

const {t} = useI18n();

const links = [
    {label: t("footer.links.label1"), href: route('page.about-us', undefined, false)},
    {label: t("footer.links.label2"), href: route('page.contact-us', undefined, false)},
    {label: t("footer.links.label3"), href: "TODO"},
    {label: t("footer.links.label4"), href: route('page.privacy', undefined, false)},
    {label: t("footer.links.label5"), href: route('page.payments', undefined, false)},
    {label: t("footer.links.label6"), href: "TODO"},
    {label: t("footer.links.label7"), href: "TODO"},
];

const socials = [
    {label: "Instagram", href: "https://www.instagram.com", icon: "pi pi-instagram"},
    {label: "Facebook", href: "https://www.facebook.com", icon: "pi pi-facebook"},
];

const phoneWhatsApp = ref("00387063144027");
const phoneAlt = ref("00387063247485");
const email = ref("mdjservice00@gmail.com");

function formattedPhone(raw: string) {
    const match = raw.match(/^00(\d{3})(\d{3})(\d{3})(\d{3})$/);
    if (match) {
        return `+${match[1]} ${match[2]} ${match[3]} ${match[4]}`;
    }
    return raw;
}
</script>

<template>
    <footer class="bg-slate-50 border-t border-slate-200 font-sans w-full mx-auto pb-10">
        <div class="max-w-5xl mx-auto">
            <div class="mx-auto gap-8 flex flex-wrap justify-between items-center p-6">

                <!-- LINKS -->
                <div
                    class="flex flex-wrap gap-4 text-slate-600 text-sm justify-center sm:justify-start"
                >
                    <a
                        v-for="(link, index) in links"
                        :key="index"
                        :href="link.href"
                        class="hover:text-blue-600 transition-colors"
                    >
                        {{ link.label }}
                    </a>
                </div>

                <!-- SOCIAL -->
                <div
                    class="flex gap-4 justify-center sm:justify-end mt-4 sm:mt-0 mx-auto sm:mx-0"
                >
                    <SocialPart container-class="space-x-6"/>
                </div>
            </div>

            <div class="text-xs text-slate-500 place-content-center w-fit mx-auto">
                <!-- Contatti a sinistra -->
                <div
                    class="w-fit flex flex-col gap-y-1 text-center sm:mx-auto sm:gap-2 sm:flex-row sm:flex-wrap sm:justify-stretch  sm:m-4 sm:mt-6 sm:text-left">
                    <!-- WhatsApp -->
                    <a
                        :href="`tel:${phoneWhatsApp}`"
                        class="hover:text-blue-600 transition-colors"
                    >
                        {{ formattedPhone(phoneWhatsApp) }}
                        <span class="text-xs text-slate-400 ml-1">(WhatsApp)</span>
                    </a>

                    <span class="hidden sm:inline text-slate-300">|</span>

                    <!-- Alt -->
                    <a
                        :href="`tel:${phoneAlt}`"
                        class="hover:text-blue-600 transition-colors"
                    >
                        {{ formattedPhone(phoneAlt) }}
                        <span class="text-xs text-slate-400 ml-1">(Alt.)</span>
                    </a>

                    <span class="hidden sm:inline text-slate-300">|</span>

                    <!-- Email -->
                    <a
                        :href="`mailto:${email}`"
                        class="hover:text-blue-600 transition-colors break-all"
                    >
                        {{ email }}
                    </a>

                    <span class="hidden sm:inline text-slate-300">|</span>

                    <!-- Indirizzo -->
                    <a
                        href="https://g.co/kgs/1vJq9fe"
                        target="_blank"
                        class="hover:text-blue-600 transition-colors"
                    >
                        Pape Ivana Pavla II 14 88266 Medjugorje, BiH
                    </a>
                </div>
            </div>
        </div>

    </footer>
</template>
