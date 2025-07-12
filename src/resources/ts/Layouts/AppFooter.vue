<script setup lang="ts">
 import logo from '@/../media/logo.png';
const phoneWhatsApp = ref('00387063144027')
const phoneAlt = ref('00387063247485')
const email = ref('mdjservice00@gmail.com')
const currentYear = ref(new Date().getFullYear())

/**
 * Formats a raw phone string like "00387063741548" into "+387 063 741 548".
 */
function formattedPhone(raw) {
    const match = raw.match(/^00(\d{3})(\d{3})(\d{3})(\d{3})$/)
    if (match) {
        return `+${match[1]} ${match[2]} ${match[3]} ${match[4]}`
    }
    return raw
}
</script>

<template>
    <footer class="bg-slate-50 border-t border-slate-200 font-sans">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex flex-col md:flex-row gap-16 lg:justify-between lg:m-4 justify-around items-center sm:items-start">

                <!-- Left Side: Info -->
                <div class="md:w-fit text-center sm:text-left">
                    <h3 class="text-md font-semibold text-slate-800">Medjugorje Service d.o.o</h3>
                    <a href="https://g.co/kgs/1vJq9fe" target="_blank" class="mt-2 inline-block text-sm text-slate-600 hover:text-blue-600 transition-colors">
                        Pape Ivana Pavla II 14<br />
                        88266 Medjugorje, BiH
                    </a>
                    <figure class="flex items-center mt-2" role="img" aria-label="Company Logo">
                        <img
                            :src="logo"
                            alt="MyCompany Logo"
                            class="h-auto w-28 object-contain mx-auto sm:mx-0"
                            loading="lazy"
                        />
                    </figure>
                </div>

                <!-- Right Side: Contact -->
                <div class="md:w-fit text-center sm:text-left">
                    <h4 class="text-md font-semibold text-slate-800">Get in touch</h4>
                    <ul class="mt-4 space-y-3 ">

                        <li>
                            <a :href="`tel:${phoneWhatsApp}`" class="flex items-start text-sm text-slate-600 hover:text-blue-600 transition-colors">
                                <svg class="flex-shrink-0 h-5 w-5 mt-0.5 mr-3 text-inherit transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" />
                                </svg>
                                {{ formattedPhone(phoneWhatsApp) }} <span class="text-xs text-slate-400 ml-1">(WhatsApp)</span>
                            </a>
                        </li>

                        <li>
                            <a :href="`tel:${phoneAlt}`" class="flex items-start text-sm text-slate-600 hover:text-blue-600 transition-colors">
                                <svg class="flex-shrink-0 h-5 w-5 mt-0.5 mr-3 text-inherit transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>
                                {{ formattedPhone(phoneAlt) }} <span class="text-xs text-slate-400 ml-1">(Alt.)</span>
                            </a>
                        </li>

                        <li>
                            <a :href="`mailto:${email}`" class="flex items-start text-sm text-slate-600 hover:text-blue-600 transition-colors break-all">
                                <svg class="flex-shrink-0 h-5 w-5 mt-0.5 mr-3 text-inherit transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                {{ email }}
                            </a>
                        </li>

                    </ul>
                </div>

            </div>

            <div class="mt-12 pt-8 border-t border-slate-200 flex flex-col sm:flex-row justify-between items-center">
                <p class="text-xs text-slate-500 order-2 sm:order-1 mt-4 sm:mt-0">
                    © {{ currentYear }} Medjugorje Service d.o.o. All rights reserved.
                </p>
                <div class="order-1 sm:order-2">
                    <div class="flex space-x-4">
                        <a href="https://www.facebook.com/medjugorjeservice" target="_blank" class="text-slate-500 hover:text-blue-600 transition-colors" aria-label="Facebook">
                            <span class="sr-only">Facebook</span>
                            <i class="pi pi-facebook" style="font-size: 1.5rem;"></i>
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </footer>

</template>



<style scoped>

</style>
