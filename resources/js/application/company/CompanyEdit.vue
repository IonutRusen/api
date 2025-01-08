<script setup>
import AppTextField from "@core/components/app-form-elements/AppTextField.vue"
import AppTextarea from "@core/components/app-form-elements/AppTextarea.vue";
import Swal from "sweetalert2";

const invalid = false
const route = useRoute()
const router = useRouter()



const name = ref('')
const website = ref(null)
const description = ref(null)

const isFormValid = ref(false)
const refForm = ref()
const errors = ref({})


/*onMounted(() => {
    fetchFacility()
})*/

const {
    data: rawCompaniesData,
}  = await useApi(createUrl(`companies/${route.params.id}`, {
    method: 'GET',
}))

const companies = computed(() => rawCompaniesData.value.data)
name.value = companies.value.attributes.name
website.value = companies.value.attributes.website
description.value = companies.value.attributes.description


/*
const fetchTimeZones = async () => {
    try {
        const res = await $api(`/options/time-zones`, {
            method: 'GET',
        })

        if (res) {
            timeZones.value = res.data
        }
    } catch (err) {
        console.error(err)
    }
}*/

const sendData = async () => {
    try {
        const res = await useApi(`companies/${route.params.id}`).put({
                name: name.value,
                website: website.value,
                description: description.value

            })

        await Swal.fire(
            'Company Updated',
            'Company has been updated successfully.',
            'success',
        )

    } catch (err) {


    }
}

const submitForm = () => {

    refForm.value?.validate().then(({ valid: isValid }) => {
        if (isValid)
            sendData()
    })
}
</script>

<template>
  <VCard flat>
    <VCardTitle
      cols="12"
      class="d-flex gap-4"
    >
      <VRow no-gutters>
        <VCol cols="6">
          Edit
        </VCol>
      </VRow>
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
              placeholder="xxxx-xxxx-xxxx"
            />
          </VCol>

          <VCol
            cols="12"
            md="12"
          >
            <AppTextarea
              v-model="description"
              label="Time Zone"
              placeholder="Select Time Zone"
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
