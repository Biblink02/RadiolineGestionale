<script setup lang="ts">
import {ref} from 'vue'
import logoPath from '£/images/logo.png'

const logo = ref(logoPath)
const phoneMain = ref('00387063741548')
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
    <footer class="bg-white border-t border-gray-300">
        <div class="max-w-5xl mx-auto px-4 py-8 flex flex-col md:flex-row md:items-start md:justify-between">
            <div class="flex-shrink-0 mb-6 md:mb-0">
                <img :src="logo" alt="Medjugorje Service Logo" class="h-16 w-auto" />
            </div>
            <div class="flex-1 md:ml-6">
                <h3 class="text-xl font-semibold text-gray-800">Medjugorje Service d.o.o</h3>
                <p class="mt-1 text-sm text-gray-700">
                    Pape Ivana Pavla II 14<br />
                    88266 Medjugorje, BiH
                </p>
                <div class="mt-4 space-y-2 text-sm text-gray-700">
                    <p>
                        <span class="font-medium">Tel:</span>
                        <a :href="`tel:${phoneMain}`" class="text-blue-600 hover:underline">
                            &nbsp{{ formattedPhone(phoneMain) }}
                        </a>
                    </p>
                    <p>
                        <span class="font-medium">Mob/WhatsApp:</span>
                        <a :href="`tel:${phoneWhatsApp}`" class="text-blue-600 hover:underline">
                            &nbsp{{ formattedPhone(phoneWhatsApp) }}
                        </a>
                    </p>
                    <p>
                        <span class="font-medium">Alt.:</span>
                        <a :href="`tel:${phoneAlt}`" class="text-blue-600 hover:underline">
                            &nbsp{{ formattedPhone(phoneAlt) }}
                        </a>
                    </p>
                    <p>
                        <span class="font-medium">Email:</span>
                        <a :href="`mailto:${email}`" class="text-blue-600 hover:underline">
                            &nbsp{{ email }}
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div class="bg-white border-t border-gray-300 text-center py-4">
            <p class="text-xs text-gray-600">
                © {{ currentYear }} Medjugorje Service d.o.o. Tutti i diritti riservati.
            </p>
        </div>
    </footer>
</template>

<style scoped>

</style>
