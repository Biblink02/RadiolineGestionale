import en from './en.json'
import it from './it.json'

export const locale = navigator.language.split('-')[0];
export const fallbackLocale = 'en';

export const languages = {
    en: {...en},
    it: {...it},
};
