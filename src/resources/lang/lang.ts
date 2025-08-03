import { createI18n } from 'vue-i18n';
async function loadLocaleMessages(locale: string) {
    return import(`../lang/${locale}/site.json`)
}

export async function createI18nInstance(locale: string, fallbackLocale: string) {
    const messages = await loadLocaleMessages(locale)

    return createI18n({
        globalInjection: true,
        locale: locale,
        fallbackLocale: fallbackLocale,
        formatFallbackMessages: true,
        messages: { [locale]: messages.default },
        legacy: false,
    })
}

export async function setLanguage(i18n, newLocale: string) {
    if (!i18n.global.availableLocales.includes(newLocale)) {
        const messages = await loadLocaleMessages(newLocale)
        i18n.global.setLocaleMessage(newLocale, messages.default)
    }
    i18n.global.locale.value = newLocale
    document.documentElement.setAttribute('lang', newLocale)
}
export function getLocaleFromUrl() {
    const path = window.location.pathname
    const match = path.match(/^\/([a-z]{2})(\/|$)/)
    return match ? match[1] : 'en'
}
