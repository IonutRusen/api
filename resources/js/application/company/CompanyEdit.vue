<script setup>
import AppTextField from "@core/components/app-form-elements/AppTextField.vue"
import AppSelect from "@core/components/app-form-elements/AppSelect.vue"
import AppTextarea from "@core/components/app-form-elements/AppTextarea.vue";

const invalid = false
const route = useRoute()
const router = useRouter()



const name = ref('')
const website = ref(null)
const description = ref(null)

const licenseNo = ref('')
const isFormValid = ref(false)
const refForm = ref()
const errors = ref({})


onMounted(() => {
    fetchFacility()
})

const fetchFacility = async () => {
    try {
        const res = await $api(`v1/companies/${route.params.id}`, {
            method: 'GET',
        })



        if (res) {
            name.value = res.data.attributes.name
            website.value = res.data.attributes.website
            description.value = res.data.attributes.description
        }
    } catch (err) {
        if (err.response && err.response.status === 403) {
            router.push('/companies/list')
        } else {
            console.error('An unexpected error occurred:', err)
        }
    }
}
/*
const fetchPayrollCycles = async () => {
    try {
        const res = await $api(`/options/payroll-cycles`, {
            method: 'GET',
        })

        if (res) {
            payrollCycles.value = res.data
        }
    } catch (err) {
        console.error(err)
    }
}

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
        const res = await $api(`v1/companies/${route.params.id}`, {
            method: 'PUT',
            body: {
                name: name.value,
                website: website.value,
                description: description.value,

                /*   pay_roll_cycle_id: payrollCycleId.value,
                company_id: 1,*/
            },
            onResponseError({ response }) {

                errors.value = response._data.errors
                console.log(response._data.errors)
            },
        })

        if (res) {
            console.log('success')
        }

      /*  await nextTick(() => {
            router.push('/companies/list')
        })*/

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
