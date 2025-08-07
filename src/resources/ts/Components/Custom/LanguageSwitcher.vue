<script setup>
import {route} from "../../../../vendor/tightenco/ziggy";
const {t} = useI18n();
const page = usePage()
const showDropdown = ref(false)
let hideTimeout = null

function onMouseEnter() {
    clearTimeout(hideTimeout)
    //showDropdown.value = true
}

function onMouseLeave() {
    hideTimeout = setTimeout(() => {
        showDropdown.value = false
    }, 500)
}

const selectedLocale = ref(page.props.locale || 'en')

function getFlagSrc(code) {
    const countryCode = code.toUpperCase() === 'EN' ? 'GB' : code.toUpperCase()
    return `https://flagsapi.com/${countryCode}/flat/24.png`
}

const otherLanguages = computed(() => {
    return page.props.languages.filter(
        (code) => code !== selectedLocale.value
    );
});

function toggleDropdown() {
    showDropdown.value = !showDropdown.value
}
</script>

<template>
    <div
        class="relative inline-block text-left"
        @mouseenter="onMouseEnter"
        @mouseleave="onMouseLeave"
        @click="toggleDropdown"
    >
        <!-- Lingua attuale -->
        <button
            type="button"
            class="flex items-center cursor-pointer w-[1.2rem] h-[1.2rem] hover:scale-110"
            :aria-label="t('LanguageSwitcher.current', { lang: selectedLocale.toUpperCase() })"
        >
            <img loading="eager" width="24" height="24"
                :src="getFlagSrc(selectedLocale)"
                class="w-full h-full"
                :alt="t('LanguageSwitcher.current', { lang: selectedLocale.toUpperCase() })"
                :title="t('LanguageSwitcher.current', { lang: selectedLocale.toUpperCase() })"
            />
        </button>

        <!-- Dropdown -->
        <div
            v-show="showDropdown"
            class="absolute mt-2 w-12 rounded-md shadow-lg bg-white ring-1 ring-gray-400 ring-opacity-5 z-10"
            role="menu"
            :aria-label="t('LanguageSwitcher.select')"
        >
            <div class="py-1 flex flex-col items-center gap-1">
                <a
                    v-for="lang in otherLanguages"
                    :key="lang"
                    class="hover:scale-110 transition-transform cursor-pointer"
                    :href="route(route().current(), { locale: lang })"
                    :aria-label="t('LanguageSwitcher.changeTo', { lang: lang.toUpperCase() })"
                >
                    <img loading="eager" width="24" height="24"
                        :src="getFlagSrc(lang)"
                        class="w-6 h-6 rounded-sm"
                        :alt="t('LanguageSwitcher.changeTo', { lang: lang.toUpperCase() })"
                        :title="t('LanguageSwitcher.changeTo', { lang: lang.toUpperCase() })"
                    />
                </a>
            </div>
        </div>
    </div>
</template>

