import en from './en/site-en.json'
import it from './it/site-it.json'
import {createI18n} from "vue-i18n";

export const locale = navigator.language.split('-')[0];
export const fallbackLocale = 'en';

export const languages = {
    en: {...en},
    it: {...it},
};

export function getLanguageOrFallback() {
    return Object.keys(languages).includes(locale) ? locale : fallbackLocale;
}

export function createI18nInstance(){
    return createI18n({
        globalInjection: true,
        locale: locale,
        fallbackLocale: fallbackLocale,
        formatFallbackMessages: true,
        messages: Object.assign(languages),
        legacy: false,
    })
}
