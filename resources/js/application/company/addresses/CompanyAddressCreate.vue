<script setup>
import { Loader } from "@googlemaps/js-api-loader";
import AppTextField from "@core/components/app-form-elements/AppTextField.vue";

const invalid = ref(false)
const isFormValid = ref(false)

const refForm = ref()
const errors = ref({
    email: undefined,
    password: undefined,
})

const address = ref('');
const city = ref('');
const state = ref('');
const zip = ref('');
const country = ref('');
const phone = ref('');
const email = ref('');

const submitForm = () => {

    refForm.value?.validate().then(({ valid: isValid }) => {
        if (isValid)
            sendData()
    })
}



</script>

<template>
    <VCard flat>

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

                        <AppTextField
                            id="place"
                            v-model="address"
                            :rules="[requiredValidator]"
                            label="Address"
                            placeholder="123 Str"
                        />
                    </VCol>
                    <VCol
                        cols="12"
                        md="6"
                    >
                        <AppTextField
                            v-model="city"
                            :rules="[requiredValidator,urlValidator]"
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
                            placeholder="State" />
                    </VCol>
                    <VCol
                        cols="12"
                        md="6">
                        <AppTextField
                            v-model="zip"
                            :rules="[requiredValidator]"
                            label="Zip"
                            placeholder="Zip" />
                    </VCol>
                    <VCol
                        cols="12"
                        md="6">
                        <AppTextField
                            v-model="country"
                            :rules="[requiredValidator]"
                            label="Country"
                            placeholder="Country" />
                    </VCol>
                    <VCol
                        cols="12"
                        md="6">
                        <AppTextField
                            v-model="phone"
                            :rules="[requiredValidator]"
                            label="Phone"
                            placeholder="Phone" />
                    </VCol>
                    <VCol
                        cols="12"
                        md="6">
                        <AppTextField
                            v-model="email"
                            :rules="[requiredValidator]"
                            label="Email"
                            placeholder="Email" />
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
                            :to="{ name: 'companies-list' }"
                        >
                            {{ $t('Back') }}
                        </VBtn>
                    </VCol>
                </VRow>
            </VForm>
        </VCardText>
    </VCard>

</template>

