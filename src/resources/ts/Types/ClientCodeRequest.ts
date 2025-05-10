// 1. Define the possible profile types
export type ProfileType = 'A' | 'G' | 'H' | 'L' | 'R'

// 2. Common fields shared by all profiles
interface BaseProfile {
    /** Discriminator for the profile variant */
    profileType: ProfileType
    /** Optional free-text message from the user */
    message?: string
    /** User must accept privacy policy */
    acceptPrivacy: boolean
}

// 3. Specific fields for each profile variant

export interface AgencyProfile extends BaseProfile {
    profileType: 'A'
    agencyName: string
    agencyCountry: string
    agencyEmail: string
    agencyRefName: string
    agencyRefSurname: string
    agencyMobile: string
}

export interface GuideProfile extends BaseProfile {
    profileType: 'G'
    guideName: string
    guideSurname: string
    guideCountry: string
    guideEmail: string
    guideMobile: string
}

export interface HotelProfile extends BaseProfile {
    profileType: 'H'
    hotelName: string
    hotelEmail: string
    hotelRefName: string
    hotelRefSurname: string
    hotelMobile: string
}

export interface LaicOrganizerProfile extends BaseProfile {
    profileType: 'L'
    laicName: string
    laicSurname: string
    laicCountry: string
    laicEmail: string
    laicMobile: string
}

export interface ReligiousAccompanistProfile extends BaseProfile {
    profileType: 'R'
    relName: string
    relSurname: string
    relCountry: string
    relEmail: string
    relMobile: string
}

// 4. Discriminated union for the complete request payload
export type ClientCodeRequestPayload =
    | AgencyProfile
    | GuideProfile
    | HotelProfile
    | LaicOrganizerProfile
    | ReligiousAccompanistProfile
