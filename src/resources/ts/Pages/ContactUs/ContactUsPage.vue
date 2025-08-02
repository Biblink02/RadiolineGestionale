<script setup lang="ts">
import AppLayout from "@/Layouts/AppLayout.vue";
import Toast from "primevue/toast";
import { useToast } from "primevue/usetoast";
import axios from "axios";
import { route } from "../../../../vendor/tightenco/ziggy";
import { getLanguageOrFallback } from "~/lang/lang";

const { t } = useI18n();
const toast = useToast();

const fallbackCountries = [
    { label: t("countries.italy"), value: "IT" },
    { label: t("countries.spain"), value: "ES" },
    { label: t("countries.portugal"), value: "PT" },
    { label: t("countries.france"), value: "FR" },
    { label: t("countries.germany"), value: "DE" },
    { label: t("countries.united-kingdom"), value: "GB" },
    { label: t("countries.bosnia-herzegovina"), value: "BA" } // Medjugorje
];

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
    { label: t("contact-us.profile.1"), value: "AGENCY" },
    { label: t("contact-us.profile.2"), value: "ORGANIZATION" },
    { label: t("contact-us.profile.3"), value: "GUIDE" },
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
    language: getLanguageOrFallback(),
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
    contactForm.post(route("api.request.contact-form", undefined, false), {
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
                        :class="{'p-invalid border-red-500': contactForm.errors.firstName}"
                    />
                    <small v-if="contactForm.errors.firstName" class="p-error">
                        {{ t(contactForm.errors.firstName) }}
                    </small>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">{{ t("contact-us.last-name") }} *</label>
                    <InputText
                        v-model="contactForm.lastName"
                        class="w-full"
                        :placeholder="t('contact-us.last-name-placeholder')"
                        :class="{'p-invalid border-red-500': contactForm.errors.lastName}"
                    />
                    <small v-if="contactForm.errors.lastName" class="p-error">
                        {{ t(contactForm.errors.lastName) }}
                    </small>
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
                        :placeholder="t('contact-us.phone-placeholder')"
                        decimalSeparator=""
                        prefix="+"
                        :class="{'p-invalid border-red-500': contactForm.errors.phone}"
                    />
                    <small v-if="contactForm.errors.phone" class="p-error">
                        {{ t(contactForm.errors.phone) }}
                    </small>
                </div>
                <div>
                    <label class="block mb-1 text-sm font-medium">{{ t("contact-us.email") }} *</label>
                    <InputText
                        v-model="contactForm.email"
                        type="email"
                        class="w-full"
                        :placeholder="t('contact-us.email-placeholder')"
                        :class="{'p-invalid border-red-500': contactForm.errors.email}"
                    />
                    <small v-if="contactForm.errors.email" class="p-error">
                        {{ t(contactForm.errors.email) }}
                    </small>
                </div>
            </div>

            <!-- Nazione e Profilo -->
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
                        :class="{'p-invalid border-red-500': contactForm.errors.country}"
                    />
                    <small v-if="contactForm.errors.country" class="p-error">
                        {{ t(contactForm.errors.country) }}
                    </small>
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
                        :class="{'p-invalid border-red-500': contactForm.errors.profileType}"
                    />
                    <small v-if="contactForm.errors.profileType" class="p-error">
                        {{ t(contactForm.errors.profileType) }}
                    </small>
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
                    :class="{'p-invalid border-red-500': contactForm.errors.message}"
                />
                <small v-if="contactForm.errors.message" class="p-error">
                    {{ t(contactForm.errors.message) }}
                </small>
            </div>

            <!-- Privacy -->
            <div class="text-center items-start mx-auto space-x-2 mb-4">
                <Checkbox v-model="contactForm.acceptPrivacy" binary inputId="privacy"/>
                <label for="privacy" class="text-sm">
                    {{ t("contact-us.privacy.accept") }}
                    <a href="#" class="text-blue-600 underline">{{ t("contact-us.privacy.link") }}</a>
                    *
                </label>
                <div v-if="contactForm.errors.acceptPrivacy" class="text-red-500 text-sm">
                    {{ t(contactForm.errors.acceptPrivacy) }}
                </div>
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
.p-error {
    font-size: 0.875rem;
    color: #ef4444;
}
</style>
