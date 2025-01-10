<script setup>
import AppTextField from "@core/components/app-form-elements/AppTextField.vue"
import AppTextarea from "@core/components/app-form-elements/AppTextarea.vue";
import Swal from "sweetalert2";
import CompanyAddressDetails from "@/application/company/addresses/CompanyAddressDetails.vue";
import CompanyAddressIndex from "@/application/company/addresses/CompanyAddressIndex.vue";

const showAddressForm = ref(false)

const invalid = false
const route = useRoute()

const name = ref('')
const website = ref(null)
const description = ref(null)

const isFormValid = ref(false)
const refForm = ref()
const errors = ref({})

const addresses = ref()

const companyid = ref()

const {
    data: rawCompaniesData,
}  = await useApi(createUrl(`companies/${route.params.id}`, {
    method: 'GET',
    query: {
        include: 'addresses.category',

    },
}))

const company = computed(() => rawCompaniesData.value.data)

companyid.value = company.value.id
name.value = company.value.attributes.name
website.value = company.value.attributes.website
description.value = company.value.attributes.description
addresses.value = rawCompaniesData.value.included

const addressToEdit = ref(null)

const toggleshowAddressForm = (addressId = null) => {

    addressToEdit.value = addressId
    showAddressForm.value = !showAddressForm.value
    if (!showAddressForm.value){
        fetchAddresses()
    }
}
const fetchAddresses = async () => {
    try {
        const res = await $api(`/companies/${companyid.value}/addresses`, {
            method: 'GET',
        })

        if (res) {
            addresses.value = res.data
        }
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
    <VCard class="mt-6">
        <CompanyAddressIndex :addresses="addresses" @showAddressForm="toggleshowAddressForm" v-if="!showAddressForm"/>
        <CompanyAddressDetails v-else :companyId="companyid" @showAddressForm="toggleshowAddressForm" :addressToEditId="addressToEdit"/>
    </VCard>
</template>
