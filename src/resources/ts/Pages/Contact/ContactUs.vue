<script setup lang="ts">
import {ref, computed} from 'vue'
import {useForm} from '@inertiajs/vue3'
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown'
import Button from 'primevue/button'
import Textarea from 'primevue/textarea'
import Checkbox from 'primevue/checkbox'
import Toast from 'primevue/toast'
import {ProfileType} from "@/Types/ClientCodeRequest";
import AppLayout from "@/Layouts/AppLayout.vue";
import {useToast} from "primevue";

const toast = useToast();

// Profile type options for dropdown
const profileOptions: { label: string; value: ProfileType }[] = [
    {label: 'Travel Agency', value: 'A'},
    {label: 'Guide', value: 'G'},
    {label: 'Accommodation Provider', value: 'H'},
    {label: 'Lay Organizer', value: 'L'},
    {label: 'Religious Accompanist', value: 'R'},
]

// Country options (add your actual country data)
const countryOptions = [
    {label: 'United States', value: 'US'},
    {label: 'Canada', value: 'CA'},
    {label: 'United Kingdom', value: 'UK'},
    {label: 'France', value: 'FR'},
    {label: 'Germany', value: 'DE'},
    {label: 'Italy', value: 'IT'},
    {label: 'Spain', value: 'ES'},
    // Add more countries as needed
]

// Selected profile type
const selectedProfileType = ref<ProfileType>('')

// Define individual forms
const agencyForm = useForm({
    profileType: 'A' as ProfileType,
    message: '',
    acceptPrivacy: false,
    A_name: '',
    A_country: '',
    A_email: '',
    A_ref_name: '',
    A_ref_surname: '',
    A_mobile: '',
})

const guideForm = useForm({
    profileType: 'G' as ProfileType,
    message: '',
    acceptPrivacy: false,
    G_name: '',
    G_surname: '',
    G_country: '',
    G_email: '',
    G_mobile: '',
})

const hotelForm = useForm({
    profileType: 'H' as ProfileType,
    message: '',
    acceptPrivacy: false,
    H_name: '',
    H_email: '',
    H_ref_name: '',
    H_ref_surname: '',
    H_mobile: '',
})

const laicForm = useForm({
    profileType: 'L' as ProfileType,
    message: '',
    acceptPrivacy: false,
    L_name: '',
    L_surname: '',
    L_country: '',
    L_email: '',
    L_mobile: '',
})

const religiousForm = useForm({
    profileType: 'R' as ProfileType,
    message: '',
    acceptPrivacy: false,
    R_name: '',
    R_surname: '',
    R_country: '',
    R_email: '',
    R_mobile: ''
})

// Compute active form based on selected profile type
const activeForm = computed(() => {
    switch (selectedProfileType.value) {
        case 'A': return agencyForm
        case 'G': return guideForm
        case 'H': return hotelForm
        case 'L': return laicForm
        case 'R': return religiousForm
        default: return null
    }
})

// Compute form validity
const isValid = computed(() => {
    const form = activeForm.value
    if (!form || !form.acceptPrivacy) return false

    // Helper: check that all listed fields are non-empty
    const allFilled = (fields: string[]) =>
        fields.every(f => Boolean((form as any)[f]))

    switch (selectedProfileType.value) {
        case 'A':
            return allFilled([
                'A_name', 'A_country', 'A_email',
                'A_ref_name', 'A_ref_surname', 'A_mobile'
            ])
        case 'G':
            return allFilled([
                'G_name', 'G_surname', 'G_country',
                'G_email', 'G_mobile'
            ])
        case 'H':
            return allFilled([
                'H_name', 'H_email', 'H_ref_name',
                'H_ref_surname', 'H_mobile'
            ])
        case 'L':
            return allFilled([
                'L_name', 'L_surname', 'L_country',
                'L_email', 'L_mobile'
            ])
        case 'R':
            return allFilled([
                'R_name', 'R_surname', 'R_country',
                'R_email', 'R_mobile'
            ])
    }
    return false
})

// Submit handler
function submit() {
    const form = activeForm.value
    if (!form) return

    form.post(route('client-code.request'), {
        onSuccess: () => {
            toast.add({severity: 'success', summary: 'Success', detail: 'Request submitted successfully!', life: 3000});
        },
        onError: () => {
            toast.add({ severity: 'error', summary: 'Error', detail: 'Failed to submit request. Please try again.', life: 3000 });
        }
    })
}
</script>

<template>
    <AppLayout>
        <Toast />
        <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Client Code Request</h1>
                    <p class="text-gray-600">Please select your profile type and fill in the required information</p>
                </div>

                <!-- Main Form Card -->
                <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                    <div class="px-6 py-8 sm:px-8 lg:px-12">
                        <!-- Profile Type Selection -->
                        <div class="mb-8">
                            <label class="block text-lg font-semibold text-gray-900 mb-4">
                                Select Your Profile Type
                            </label>
                            <Dropdown
                                v-model="selectedProfileType"
                                :options="profileOptions"
                                optionLabel="label"
                                optionValue="value"
                                placeholder="Choose your profile..."
                                class="w-full md:w-1/2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            />
                        </div>

                        <!-- Dynamic Form Content -->
                        <div v-if="activeForm" class="space-y-6">

                            <!-- Travel Agency Form -->
                            <div v-if="selectedProfileType === 'A'" class="space-y-6">
                                <div class="border-l-4 border-blue-500 pl-4">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Travel Agency Information</h3>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Agency Name</label>
                                        <InputText
                                            v-model="activeForm.A_name"
                                            placeholder="Enter agency name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                        <Dropdown
                                            v-model="activeForm.A_country"
                                            :options="countryOptions"
                                            optionLabel="label"
                                            optionValue="value"
                                            placeholder="Select country"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Agency Email</label>
                                        <InputText
                                            v-model="activeForm.A_email"
                                            type="email"
                                            placeholder="agency@example.com"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact First Name</label>
                                        <InputText
                                            v-model="activeForm.A_ref_name"
                                            placeholder="First name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Last Name</label>
                                        <InputText
                                            v-model="activeForm.A_ref_surname"
                                            placeholder="Last name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile (with WhatsApp)</label>
                                        <InputText
                                            v-model="activeForm.A_mobile"
                                            type="tel"
                                            placeholder="+1 234 567 8900"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Guide Form -->
                            <div v-if="selectedProfileType === 'G'" class="space-y-6">
                                <div class="border-l-4 border-green-500 pl-4">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Guide Information</h3>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                        <InputText
                                            v-model="activeForm.G_name"
                                            placeholder="First name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                        <InputText
                                            v-model="activeForm.G_surname"
                                            placeholder="Last name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                        <Dropdown
                                            v-model="activeForm.G_country"
                                            :options="countryOptions"
                                            optionLabel="label"
                                            optionValue="value"
                                            placeholder="Select country"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                        <InputText
                                            v-model="activeForm.G_email"
                                            type="email"
                                            placeholder="guide@example.com"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile (with WhatsApp)</label>
                                        <InputText
                                            v-model="activeForm.G_mobile"
                                            type="tel"
                                            placeholder="+1 234 567 8900"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Accommodation Provider Form -->
                            <div v-if="selectedProfileType === 'H'" class="space-y-6">
                                <div class="border-l-4 border-purple-500 pl-4">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Accommodation Provider Information</h3>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Property Name</label>
                                        <InputText
                                            v-model="activeForm.H_name"
                                            placeholder="Hotel/Property name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                        <InputText
                                            v-model="activeForm.H_email"
                                            type="email"
                                            placeholder="hotel@example.com"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact First Name</label>
                                        <InputText
                                            v-model="activeForm.H_ref_name"
                                            placeholder="First name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Last Name</label>
                                        <InputText
                                            v-model="activeForm.H_ref_surname"
                                            placeholder="Last name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile (with WhatsApp)</label>
                                        <InputText
                                            v-model="activeForm.H_mobile"
                                            type="tel"
                                            placeholder="+1 234 567 8900"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Lay Organizer Form -->
                            <div v-if="selectedProfileType === 'L'" class="space-y-6">
                                <div class="border-l-4 border-orange-500 pl-4">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Lay Organizer Information</h3>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                        <InputText
                                            v-model="activeForm.L_name"
                                            placeholder="First name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                        <InputText
                                            v-model="activeForm.L_surname"
                                            placeholder="Last name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                        <Dropdown
                                            v-model="activeForm.L_country"
                                            :options="countryOptions"
                                            optionLabel="label"
                                            optionValue="value"
                                            placeholder="Select country"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                        <InputText
                                            v-model="activeForm.L_email"
                                            type="email"
                                            placeholder="organizer@example.com"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile (with WhatsApp)</label>
                                        <InputText
                                            v-model="activeForm.L_mobile"
                                            type="tel"
                                            placeholder="+1 234 567 8900"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Religious Accompanist Form -->
                            <div v-if="selectedProfileType === 'R'" class="space-y-6">
                                <div class="border-l-4 border-red-500 pl-4">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Religious Accompanist Information</h3>
                                </div>

                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                        <InputText
                                            v-model="activeForm.R_name"
                                            placeholder="First name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                        <InputText
                                            v-model="activeForm.R_surname"
                                            placeholder="Last name"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Country</label>
                                        <Dropdown
                                            v-model="activeForm.R_country"
                                            :options="countryOptions"
                                            optionLabel="label"
                                            optionValue="value"
                                            placeholder="Select country"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                        <InputText
                                            v-model="activeForm.R_email"
                                            type="email"
                                            placeholder="accompanist@example.com"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>

                                    <div class="lg:col-span-2">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Mobile (with WhatsApp)</label>
                                        <InputText
                                            v-model="activeForm.R_mobile"
                                            type="tel"
                                            placeholder="+1 234 567 8900"
                                            class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Message Section -->
                            <div class="space-y-3">
                                <label class="block text-lg font-semibold text-gray-900">Your Message</label>
                                <Textarea
                                    v-model="activeForm.message"
                                    :rows="4"
                                    placeholder="Please provide any additional information or specific requirements..."
                                    class="w-full border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                />
                            </div>

                            <!-- Privacy Consent -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-start space-x-3">
                                    <Checkbox
                                        v-model="activeForm.acceptPrivacy"
                                        inputId="privacy"
                                        binary
                                        class="mt-1"
                                    />
                                    <label for="privacy" class="text-sm text-gray-700 leading-relaxed">
                                        I consent to the processing of my personal data in accordance with the privacy policy.
                                        This information will be used solely for processing your client code request.
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="flex justify-end pt-6">
                                <Button
                                    label="Submit Request"
                                    icon="pi pi-send"
                                    :disabled="!isValid"
                                    @click="submit"
                                    class="px-8 py-3 text-lg rounded-lg transition-all duration-200"
                                    :class="{
                                        'opacity-50 cursor-not-allowed': !isValid,
                                        'bg-blue-600 hover:bg-blue-700 text-white': isValid
                                    }"
                                />
                            </div>
                        </div>

                        <!-- No Profile Selected Message -->
                        <div v-else class="text-center py-12">
                            <div class="mx-auto h-24 w-24 text-gray-400 mb-4">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-2">Select a Profile Type</h3>
                            <p class="text-gray-500">Please choose your profile type from the dropdown above to continue.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>

</style>
