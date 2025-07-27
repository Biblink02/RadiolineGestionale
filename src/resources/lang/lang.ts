import en from './en/site-en.json'
import it from './it/site-it.json'

export const locale = navigator.language.split('-')[0];
export const fallbackLocale = 'en';

export const languages = {
    en: {...en},
    it: {...it},
};

export function getLanguageOrFallback() {
    return Object.keys(languages).includes(locale) ? locale : fallbackLocale;
}
