<script setup>
import AppTextField from "@core/components/app-form-elements/AppTextField.vue";
import { loadGoogleMapsApi } from '@/utils/loadGoogleMapsApi.js';
import { GoogleMap, AdvancedMarker } from 'vue3-google-map'


const props = defineProps({
    'companyId': String,
    'addressToEditId': String,
})
let apikey = import.meta.env.VITE_APP_GOOGLE_MAPS_API_KEY
const invalid = ref(false)
const isFormValid = ref(false)
const addressToEditId = ref()


addressToEditId.value = props.addressToEditId
onMounted(async () => {
    if (addressToEditId.value) {
        await fetchAddress()
    }
})
async function fetchAddress() {
    const {
        data: rawAddressData,
    }  = await useApi(createUrl(`companies/${props.companyId}/addresses/${addressToEditId.value}`, {
        method: 'GET',
    }))
}


const refForm = ref()
const errors = ref({
    email: undefined,
    password: undefined,
})

const address = ref();
const city = ref();
const state = ref();
const zip = ref();
const country = ref();
const phone = ref();
const email = ref();
const lat = ref();
const lng = ref();



const sendData = async () => {
    try {
        const res = await $api('/companies/' + props.companyId + '/addresses', {
            method: 'POST',
            body: {
                company_id: props.companyId,
                address: address.value,
                city: city.value,
                state: state.value,
                zip: zip.value,
                country: country.value,
                phone: phone.value,
                email: email.value,
                lat: lat.value,
                lng: lng.value,

            },
            onResponseError({ response }) {
                console.log(response._data.errors)
                errors.value = response._data.errors
            },
        })


        await nextTick(() => {
           //emit showAddressForm
            emit('showAddressForm')
        })

    } catch (err) {
        console.error(err)
    }
}

let autocomplete;
const emit = defineEmits(['showAddressForm'])

const submitForm = () => {

    refForm.value?.validate().then(({valid: isValid}) => {
        if (isValid)
            sendData()
    })
}



const autocompleteInput = ref(null)
onMounted(async () => {
    try {
        const google = await loadGoogleMapsApi(apikey);

        // Access the raw input field element inside AppTextField
        const inputField = autocompleteInput.value?.$el.querySelector('input') || autocompleteInput.value;

        if (!inputField) {
            console.warn('Input field not found for Google Maps Autocomplete');
            return;
        }

        // Initialize the Google Maps Autocomplete
        const autocomplete = new google.maps.places.Autocomplete(inputField, {
            types: ['geocode'], // Limit results to geocoded addresses
            componentRestrictions: { country: 'ro' }, // Restrict to RO
            // get lat and lng

        });

        // Listen for the `place_changed` event
        autocomplete.addListener('place_changed', () => {
            const place = autocomplete.getPlace();

            if (place && place.formatted_address) {

                lat.value = place.geometry.location.lat()
                lng.value = place.geometry.location.lng()
                //map all the address components
                place.address_components.forEach((component) => {
                    const componentType = component.types[0];
                    switch (componentType) {

                        case 'street_number':
                            address.value = component.long_name;
                            break;
                        case 'route':
                            address.value += ' ' + component.long_name;
                            break;
                        case 'locality':
                            city.value = component.long_name;
                            break;
                        case 'administrative_area_level_1':
                            state.value = component.short_name;
                            break;
                        case 'postal_code':
                            zip.value = component.long_name;
                            break;
                        case 'country':
                            country.value = component.long_name;
                            break;
                        default:
                            break;
                    }
                });

            } else {
                console.warn('No address found in Google Autocomplete response');
            }
        });
    } catch (error) {
        console.error('Error loading Google Maps API:', error);
    }
});

</script>

<template>
    <VCard flat>


<!--        <GoogleMap
            :api-key="apikey"
            mapId="DEMO_MAP_ID"
            style="width: 100%; height: 500px"
            :center="center"
            :zoom="15"
        >
            <AdvancedMarker :options="markerOptions" :pin-options="pinOptions"/>
        </GoogleMap>-->



        <VCardText>
            <VForm
                ref="refForm"
                v-model="isFormValid"
                @submit.prevent="submitForm"
            >
                <VRow>
                    <VCol
                        cols="12"
                        md="12"
                    >

                    </VCol>
                    <VCol
                        cols="12"
                        md="12"
                    >

                        <AppTextField
                            :rules="[requiredValidator]"
                            label="Address"
                            placeholder="123 Str"
                            @change="$emit('update:street', $event.target.value)"
                            v-model="address"
                            ref="autocompleteInput"
                        />
                    </VCol>
                    <VCol
                        cols="12"
                        md="6"
                    >
                        <AppTextField
                            v-model="city"
                            :rules="[requiredValidator]"
                            label="City"
                            placeholder="City"
                        />
                    </VCol>
                    <VCol
                        cols="12"
                        md="6">
                        <AppTextField
                            v-model="state"
                            :rules="[requiredValidator]"
                            label="State"
                            placeholder="State"/>
                    </VCol>
                    <VCol
                        cols="12"
                        md="6">
                        <AppTextField
                            v-model="zip"
                            :rules="[requiredValidator]"
                            label="Zip"
                            placeholder="Zip"/>
                    </VCol>
                    <VCol
                        cols="12"
                        md="6">
                        <AppTextField
                            v-model="country"
                            :rules="[requiredValidator]"
                            label="Country"
                            placeholder="Country"/>
                    </VCol>
                    <VCol
                        cols="12"
                        md="6">
                        <AppTextField
                            v-model="phone"
                            :rules="[requiredValidator]"
                            label="Phone"
                            placeholder="Phone"/>
                    </VCol>
                    <VCol
                        cols="12"
                        md="6">
                        <AppTextField
                            v-model="email"
                            :rules="[requiredValidator]"
                            label="Email"
                            placeholder="Email"/>
                    </VCol>


                    <VCol
                        cols="12"
                        class="d-flex gap-4"
                    >
                        <VBtn
                            type="submit"
                            :disabled=" invalid "
                        >
                            Submit
                        </VBtn>
                        <VBtn
                            color="secondary"
                            variant="tonal"
                            prepend-icon="tabler-arrow-left"
                            @click="$emit('showAddressForm')"
                        >
                            {{ $t('Back') }}
                        </VBtn>
                    </VCol>
                </VRow>
            </VForm>
        </VCardText>
    </VCard>

</template>

