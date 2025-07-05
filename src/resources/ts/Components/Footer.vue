<script setup lang="ts">
import {ref} from 'vue'
import logoPath from '£/images/logo.png'

const logo = ref(logoPath)
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
    <footer class="bg-slate-50 border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

                <div class="md:col-span-2">
                    <img :src="logo" alt="Medjugorje Service Logo" class="h-12 w-auto mb-4" />
                    <h3 class="text-lg font-semibold text-slate-800">Medjugorje Service d.o.o</h3>
                    <a href="https://g.co/kgs/1vJq9fe" target="_blank" class="mt-2 text-sm text-slate-600">
                        Pape Ivana Pavla II 14<br />
                        88266 Medjugorje, BiH
                    </a>
                </div>

                <div>
                    <!--
                    <h4 class="text-sm font-semibold text-slate-800 tracking-wider uppercase">Link Utili</h4>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-sm text-slate-600 hover:text-blue-600 transition-colors">Chi Siamo</a></li>
                        <li><a href="#" class="text-sm text-slate-600 hover:text-blue-600 transition-colors">Servizi</a></li>
                        <li><a href="#" class="text-sm text-slate-600 hover:text-blue-600 transition-colors">Contatti</a></li>
                        <li><a href="#" class="text-sm text-slate-600 hover:text-blue-600 transition-colors">Privacy Policy</a></li>
                    </ul>
                    -->
                </div>

                <div>
                    <h4 class="text-sm font-semibold text-slate-800 tracking-wider uppercase">Get in touch</h4>
                    <ul class="mt-4 space-y-3">
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-slate-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z" /></svg>
                            <a :href="`tel:${phoneWhatsApp}`" class="ml-3 text-sm text-slate-600 hover:text-blue-600 transition-colors">
                                {{ formattedPhone(phoneWhatsApp) }} <span class="text-xs text-slate-400">(WhatsApp)</span>
                            </a>
                        </li>
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-slate-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" /></svg>
                            <a :href="`tel:${phoneAlt}`" class="ml-3 text-sm text-slate-600 hover:text-blue-600 transition-colors">
                                {{ formattedPhone(phoneAlt) }} <span class="text-xs text-slate-400">(Alt.)</span>
                            </a>
                        </li>
                        <li class="flex items-start">
                            <svg class="flex-shrink-0 h-5 w-5 text-slate-500 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" /></svg>
                            <a :href="`mailto:${email}`" class="ml-3 text-sm text-slate-600 hover:text-blue-600 transition-colors break-all">
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
                        <a href="https://www.facebook.com/medjugorjeservice" target="_blank" class="text-slate-500 hover:text-blue-600 transition-colors">
                            <span class="sr-only">Facebook</span>
                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </footer>
</template>



<style scoped>

</style>
