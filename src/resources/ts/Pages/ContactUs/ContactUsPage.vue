<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import Toast from "primevue/toast";
import {useToast} from "primevue/usetoast";
import axios from "axios";
import {route} from "../../../../vendor/tightenco/ziggy";

const {t} = useI18n();
const toast = useToast();

const fallbackCountries = [
    {label: t("countries.italy"), value: "IT"},
    {label: t("countries.spain"), value: "ES"},
    {label: t("countries.portugal"), value: "PT"},
    {label: t("countries.france"), value: "FR"},
    {label: t("countries.germany"), value: "DE"},
    {label: t("countries.united-kingdom"), value: "GB"},
    {label: t("countries.bosnia-herzegovina"), value: "BA"} // Medjugorje
]

onMounted(async () => {
    try {
        const res = await axios.get("https://restcountries.com/v3.1/all?fields=name,cca2")
        countryOptions.value = res.data
            .map((c: any) => {
                let label = c.name.common
                if (c.name.nativeName) {
                    const firstLangKey = Object.keys(c.name.nativeName)[0]
                    if (firstLangKey && c.name.nativeName[firstLangKey]?.common) {
                        label = c.name.nativeName[firstLangKey].common
                    }
                }
                return {
                    label,
                    value: c.cca2
                }
            })
            .sort((a: any, b: any) => a.label.localeCompare(b.label))
    } catch (error) {
        console.error("Error loading nations:", error)
        countryOptions.value = fallbackCountries
    }
})

// Dropdown profilo
const profileOptions = [
    {label: t("contact-us.profile.1"), value: "agency"},
    {label: t("contact-us.profile.2"), value: "org"},
    {label: t("contact-us.profile.3"), value: "spiritual"},
];

// Stati form
const contactForm = useForm({
    firstName: "",
    lastName: "",
    phone: "",
    email: "",
    country: null,
    profileType: null,
    message: "",
    acceptPrivacy: false,
});
const countryOptions = ref<{ label: string; value: string }[]>();


const isValid = computed(() => {
    return (
        contactForm.firstName &&
        contactForm.lastName &&
        contactForm.email &&
        contactForm.country &&
        contactForm.message &&
        contactForm.acceptPrivacy
    );
});

const submit = () => {
    contactForm.phone = '+'.concat(contactForm.phone);
    contactForm.post(route("api.request.contact-form"), {
        onSuccess: () => {
            toast.add({
                severity: "success",
                summary: t("contact-us.toast.success.title"),
                detail: t("contact-us.toast.success.message"),
                life: 3000,
            });
        },
        onError: () => {
            toast.add({
                severity: "error",
                summary: t("contact-us.toast.error.title"),
                detail: t("contact-us.toast.error.message"),
                life: 3000,
            });
        },
    });
    contactForm.phone = contactForm.phone.replace('+', '');
};
</script>

<template>
    <AppLayout :title="t('contact-us.title')">
        <Toast/>
        <div class="max-w-3xl mx-auto p-6">
            <h1 class="text-2xl font-bold mb-6 text-center">{{ t("contact-us.form-title") }}</h1>

            <!-- Nome e Cognome -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 text-sm font-medium">{{ t("contact-us.first-name") }} *</label>
                    <InputText
                        v-model="contactForm.firstName"
                        class="w-full"
                        :placeholder="t('contact-us.firstNamePlaceholder')"
                    />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">{{ t("contact-us.last-name") }} *</label>
                    <InputText
                        v-model="contactForm.lastName"
                        class="w-full"
                        :placeholder="t('contact-us.last-name-placeholder')"
                    />
                </div>
            </div>

            <!-- Telefono e Email -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 text-sm font-medium">{{ t("contact-us.phone") }}</label>
                    <InputNumber
                        v-model="contactForm.phone"
                        class="w-full"
                        :mode="'decimal'"
                        :useGrouping="false"
                        decimalSeparator=""
                        prefix="+"
                    />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">{{ t("contact-us.email") }} *</label>
                    <InputText
                        v-model="contactForm.email"
                        type="email"
                        class="w-full"
                        :placeholder="t('contact-us.email-placeholder')"
                    />
                </div>
            </div>

            <!-- Nazione e Profilo sulla stessa riga (da desktop) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block mb-1 text-sm font-medium">{{ t("contact-us.country-label") }}</label>
                    <Select
                        v-model="contactForm.country"
                        :options="countryOptions"
                        optionLabel="label"
                        optionValue="value"
                        filter
                        :placeholder="t('contact-us.country-placeholder')"
                        class="w-full"
                    />
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">{{ t("contact-us.profile.label") }}</label>
                    <Select
                        v-model="contactForm.profileType"
                        :options="profileOptions"
                        optionLabel="label"
                        optionValue="value"
                        :placeholder="t('contact-us.profile.placeholder')"
                        class="w-full"
                    />
                </div>
            </div>

            <!-- Messaggio -->
            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium">{{ t("contact-us.message") }} *</label>
                <Textarea
                    v-model="contactForm.message"
                    rows="4"
                    class="w-full"
                    :placeholder="t('contact-us.message-placeholder')"
                />
            </div>

            <!-- Privacy -->
            <div class="text-center items-start mx-auto space-x-2 mb-4">
                <Checkbox v-model="contactForm.acceptPrivacy" binary inputId="privacy"/>
                <label for="privacy" class="text-sm">
                    {{ t("contact-us.privacy.accept") }}
                    <a href="#" class="text-blue-600 underline">{{ t("contact-us.privacy.link") }}</a>
                    *
                </label>
            </div>

            <!-- Pulsante -->
            <div class="mx-auto text-center">
                <Button
                    :label="t('contact-us.submit')"
                    icon="pi pi-send"
                    :disabled="!isValid"
                    @click="submit"
                    class="w-auto"
                />
            </div>
        </div>
    </AppLayout>
</template>
<style scoped>
</style>
