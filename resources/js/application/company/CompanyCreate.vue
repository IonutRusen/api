<script setup>
import AppTextField from "@core/components/app-form-elements/AppTextField.vue"
import AppSelect from "@core/components/app-form-elements/AppSelect.vue"

const router = useRouter()
const payrollCycles = ref([])
const timeZones = ref([])
const name = ref('')
const timeZoneId = ref(null)
const payrollCycleId = ref(null)
const licenseNo = ref('')
const isFormValid = ref(false)
const refForm = ref()
const errors = ref({})




const sendData = async () => {
  try {
    const res = await $api('/company', {
      method: 'POST',
      body: {
        name: name.value,
        licenceNo: licenseNo.value,
        timeZoneId: timeZoneId.value,
        payrollCycleId: payrollCycleId.value,
        companyId: 1,
      },
      onResponseError({ response }) {
        if (response.status === 422) {
          errors.value = response._data.errors
        }

      },
    })

    if (res) {
      console.log('success')
    }

    await nextTick(() => {
      router.push('/company/list')
    })

  } catch (err) {
    console.error(err)
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
              label="Facility Name"
              placeholder="Splash"
            />
          </VCol>

          <VCol
            cols="12"
            md="6"
          >
            <AppTextField
              v-model="licenseNo"

              label="License Number"
              placeholder="xxxx-xxxx-xxxx"
            />
            <span
              v-if="errors.licence_no"
              class="text-red-600"
            >{{ errors.licence_no[0] }}</span>
          </VCol>

          <VCol
            cols="12"
            md="6"
          >
            <AppSelect
              v-model="timeZoneId"
              label="Time Zone"
              placeholder="Select Time Zone"
              :items="timeZones"

              item-title="name"
              item-value="id"
            />
            <span
              v-if="errors.time_zone_id"
              class="text-red"
            >{{ errors.time_zone_id[0] }}</span>
          </VCol>

          <VCol
            cols="12"
            md="6"
          >
            <AppSelect
              v-model="payrollCycleId"
              label="Payroll Cycle"
              placeholder="Select Payroll Cycle"
              :items="payrollCycles"

              item-title="name"
              item-value="id"
            />
            <span
              v-if="errors.pay_roll_cycle_id"
              class="v-messages__message"
            >{{ errors.pay_roll_cycle_id[0] }}</span>
          </VCol>

          <VCol
            cols="12"
            class="d-flex gap-4"
          >
            <VBtn type="submit">
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
