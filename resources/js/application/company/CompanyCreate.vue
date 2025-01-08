<script setup>
import AppTextField from "@core/components/app-form-elements/AppTextField.vue"
import AppSelect from "@core/components/app-form-elements/AppSelect.vue"
import AppTextarea from "@core/components/app-form-elements/AppTextarea.vue";

const router = useRouter()
const invalid = ref(false)
const name = ref('')
const website = ref(null)
const description = ref(null)

const isFormValid = ref(false)
const refForm = ref()
const errors = ref({
    email: undefined,
    password: undefined,
})

website.value = 'https://www.splash.com'
name.value = 'dsadas'
description.value = 'dsadas'

const sendData = async () => {
    try {
        const res = await $api('companies', {
            method: 'POST',
            body: {
                name: name.value,
                website: website.value,
                description: description.value,
            },
            onResponseError({ response }) {
                console.log(response._data.errors)
                errors.value = response._data.errors
            },
        })



        await nextTick(() => {
            router.replace('/companies/edit/' + res.id)
        })

    } catch (err) {
        console.error(err)
    }
}

    const submitForm = () => {

        refForm.value?.validate().then(({valid: isValid}) => {
            if (isValid)
                sendData()
        })
    }
</script>

<template>
    <VCard flat>
        <VCardTitle>
            Create New Company
        </VCardTitle>
        <VCardText>
            <VForm
                ref="refForm"
                v-model="isFormValid"
                @submit.prevent="submitForm"
            >
                <VRow>
                    <VCol
                        cols="12"
                        md="6"
                    >
                        <AppTextField
                            v-model="name"
                            :rules="[requiredValidator]"
                            label="Name"
                            placeholder="Splash"
                            :error-messages="errors.name"
                        />
                    </VCol>
                    <VCol
                        cols="12"
                        md="6"
                    >
                        <AppTextField
                            v-model="website"
                            :rules="[requiredValidator,urlValidator]"
                            label="Website"
                            placeholder="https://www.splash.com"
                        />
                    </VCol>

                    <VCol
                        cols="12"
                        md="12"
                    >
                        <AppTextarea
                            v-model="description"
                            label="Description"
                            placeholder="Description"
                            :items="description"
                            :rules="[requiredValidator]"
                        />
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
