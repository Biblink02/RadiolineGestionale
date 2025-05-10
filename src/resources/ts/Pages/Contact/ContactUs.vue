<script setup lang="ts">
import {ref, computed} from 'vue'
import {useForm} from '@inertiajs/vue3'
import SelectButton from 'primevue/selectbutton'
import InputText from 'primevue/inputtext'
import Dropdown from 'primevue/dropdown'
import Button from 'primevue/button'
import {ClientCodeRequestPayload, ProfileType} from "@/Types/ClientCodeRequest";


// 1. Define the SelectButton options for profileType
const profileOptions: { label: string; value: ProfileType }[] = [
    {label: 'Travel Agency', value: 'A'},
    {label: 'Guide', value: 'G'},
    {label: 'Accommodation Provider', value: 'H'},
    {label: 'Lay Organizer', value: 'L'},
    {label: 'Religious Accompanist', value: 'R'},
]

// 2. Initialize the Inertia form with full typing
const form = useForm<ClientCodeRequestPayload>({
    profileType: '' as ProfileType,
    message: '',
    acceptPrivacy: false,

    // Agency fields
    agencyName: '',
    agencyCountry: '',
    agencyEmail: '',
    agencyRefName: '',
    agencyRefSurname: '',
    agencyMobile: '',

    // Guide fields
    guideName: '',
    guideSurname: '',
    guideCountry: '',
    guideEmail: '',
    guideMobile: '',

    // Hotel fields
    hotelName: '',
    hotelEmail: '',
    hotelRefName: '',
    hotelRefSurname: '',
    hotelMobile: '',

    // Lay Organizer fields
    laicName: '',
    laicSurname: '',
    laicCountry: '',
    laicEmail: '',
    laicMobile: '',

    // Religious Accompanist fields
    relName: '',
    relSurname: '',
    relCountry: '',
    relEmail: '',
    relMobile: ''
})

// 3. Compute basic form validity based on profileType
const isValid = computed(() => {
    if (!form.profileType || !form.acceptPrivacy) return false

    // Helper: check that all listed fields are non-empty
    const allFilled = (fields: (keyof ClientCodeRequestPayload)[]) =>
        fields.every(f => Boolean((form as any)[f]))

    switch (form.profileType) {
        case 'A':
            return allFilled([
                'agencyName', 'agencyCountry', 'agencyEmail',
                'agencyRefName', 'agencyRefSurname', 'agencyMobile'
            ])
        case 'G':
            return allFilled([
                'guideName', 'guideSurname', 'guideCountry',
                'guideEmail', 'guideMobile'
            ])
        case 'H':
            return allFilled([
                'hotelName', 'hotelEmail', 'hotelRefName',
                'hotelRefSurname', 'hotelMobile'
            ])
        case 'L':
            return allFilled([
                'laicName', 'laicSurname', 'laicCountry',
                'laicEmail', 'laicMobile'
            ])
        case 'R':
            return allFilled([
                'relName', 'relSurname', 'relCountry',
                'relEmail', 'relMobile'
            ])
    }
    return false
})

// 4. Submit handler
function submit() {
    form.post(route('client-code.request'), {
        onSuccess: () => {
            // You can show a toast or reset the form, etc.
        }
    })
}
</script>

<template>
    <div class="flex justify-center mt-12">
        <div class="w-full max-w-4xl p-6 bg-white shadow-md rounded-lg">
            <!-- Profile selector -->
            <div class="mb-6">
                <label class="block mb-2 font-medium text-gray-700 pb-3">
                    Select your profile
                </label>
                <div class="w-fit mx-auto">
                    <SelectButton
                        v-model="form.profileType"
                        :options="profileOptions"
                        optionLabel="label"
                        optionValue="value"
                        class="w-fit"
                    />
                </div>
            </div>
            <div v-show="form.profileType !== ''">
                <!-- Agency -->
                <div v-if="form.profileType==='A'" class="space-y-4">
                    <h3 class="font-semibold">Travel Agency</h3>
                    <InputText v-model="form.agencyName" placeholder="Agency Name" class="w-full"/>
                    <Dropdown
                        v-model="form.agencyCountry"
                        :options="countryOptions"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Country"
                        class="w-full"
                    />
                    <InputText v-model="form.agencyEmail" type="email" placeholder="Agency Email" class="w-full"/>
                    <div class="grid grid-cols-2 gap-4">
                        <InputText v-model="form.agencyRefName" placeholder="Contact First Name"/>
                        <InputText v-model="form.agencyRefSurname" placeholder="Contact Last Name"/>
                    </div>
                    <InputText v-model="form.agencyMobile" type="tel" placeholder="Mobile (with WhatsApp)"
                               class="w-full"/>
                </div>

                <!-- Guide -->
                <div v-if="form.profileType==='G'" class="space-y-4">
                    <h3 class="font-semibold">Guide</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <InputText v-model="form.guideName" placeholder="First Name"/>
                        <InputText v-model="form.guideSurname" placeholder="Last Name"/>
                    </div>
                    <Dropdown
                        v-model="form.guideCountry"
                        :options="countryOptions"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Country"
                        class="w-full"
                    />
                    <InputText v-model="form.guideEmail" type="email" placeholder="Email" class="w-full"/>
                    <InputText v-model="form.guideMobile" type="tel" placeholder="Mobile (with WhatsApp)"
                               class="w-full"/>
                </div>

                <!-- Accommodation Provider -->
                <div v-if="form.profileType==='H'" class="space-y-4">
                    <h3 class="font-semibold">Accommodation Provider</h3>
                    <InputText v-model="form.hotelName" placeholder="Property Name" class="w-full"/>
                    <InputText v-model="form.hotelEmail" type="email" placeholder="Email" class="w-full"/>
                    <div class="grid grid-cols-2 gap-4">
                        <InputText v-model="form.hotelRefName" placeholder="Contact First Name"/>
                        <InputText v-model="form.hotelRefSurname" placeholder="Contact Last Name"/>
                    </div>
                    <InputText v-model="form.hotelMobile" type="tel" placeholder="Mobile (with WhatsApp)"
                               class="w-full"/>
                </div>

                <!-- Lay Organizer -->
                <div v-if="form.profileType==='L'" class="space-y-4">
                    <h3 class="font-semibold">Lay Organizer</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <InputText v-model="form.laicName" placeholder="First Name"/>
                        <InputText v-model="form.laicSurname" placeholder="Last Name"/>
                    </div>
                    <Dropdown
                        v-model="form.laicCountry"
                        :options="countryOptions"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Country"
                        class="w-full"
                    />
                    <InputText v-model="form.laicEmail" type="email" placeholder="Email" class="w-full"/>
                    <InputText v-model="form.laicMobile" type="tel" placeholder="Mobile (with WhatsApp)"
                               class="w-full"/>
                </div>

                <!-- Religious Accompanist -->
                <div v-if="form.profileType==='R'" class="space-y-4">
                    <h3 class="font-semibold">Religious Accompanist</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <InputText v-model="form.relName" placeholder="First Name"/>
                        <InputText v-model="form.relSurname" placeholder="Last Name"/>
                    </div>
                    <Dropdown
                        v-model="form.relCountry"
                        :options="countryOptions"
                        optionLabel="label"
                        optionValue="value"
                        placeholder="Country"
                        class="w-full"
                    />
                    <InputText v-model="form.relEmail" type="email" placeholder="Email" class="w-full"/>
                    <InputText v-model="form.relMobile" type="tel" placeholder="Mobile (with WhatsApp)" class="w-full"/>
                </div>

                <!-- Message -->
                <div class="mt-6">
                    <label class="block mb-1 font-medium text-gray-700">Your Message</label>
                    <textarea
                        v-model="form.message"
                        rows="4"
                        class="w-full border border-gray-400 rounded-md"
                    ></textarea>
                </div>

                <!-- Privacy consent -->
                <div class="mt-4 flex items-center">
                    <input
                        type="checkbox"
                        v-model="form.acceptPrivacy"
                        id="privacy"
                        class="h-4 w-4 text-blue-600"
                    />
                    <label for="privacy" class="ml-2 text-sm">
                        I consent to the processing of personal data
                    </label>
                </div>

                <!-- Submit button -->
                <div class="mt-6 text-right">
                    <Button
                        label="Submit"
                        icon="pi pi-arrow-up-right"
                        :disabled="!isValid"
                        @click="submit"
                    />
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Make SelectButton chips fully rounded */
.p-selectbutton .p-button {
    border-radius: 9999px;
}
</style>
