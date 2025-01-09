<script setup>

const route = useRoute()
const props = defineProps({
 'addresses': Array
})
const companyId = `${route.params.id}`

const headers = [
    {
        title: 'Name',
        key: 'name',
    },
    {
        title: 'City',
        key: 'city',

    },
    {
        title: 'State',
        key: 'State',
    },
    {
        title: 'Email',
        key: 'email',
    },
    {
        title: 'Phone',
        key: 'phone',
    },
    {
        title: 'Actions',
        key: 'actions',
        sortable: false,
    },

]
</script>

<template>
    <section>
        <VCard class="mb-6">
            <VCardText class="d-flex flex-wrap gap-4">
                <VSpacer />
                <div class="app-user-search-filter d-flex align-center flex-wrap gap-4">
                    <VBtn
                        prepend-icon="tabler-plus"
                        @click="$emit('showAddressForm')"
                    >
                        {{ $t('Add New Location') }}
                    </VBtn>
                </div>
            </VCardText>

            <VDivider />

            <VTable

                class="text-no-wrap"
            >
                <thead>
                    <tr>
                        <th v-for="header in headers">
                            {{ header.title }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                <tr v-if="addresses.length === 0">
                    <td colspan="6">
                        <div class="d-flex justify-center align-center">
                            <p class="text-center">
                                No addresses found
                            </p>
                        </div>
                    </td>
                </tr>
                <tr v-else v-for="address in addresses">
                    <td>
                        <div class="d-flex align-center gap-x-4">
                            <div class="d-flex flex-column">
                                {{ address.attributes.address }}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-center gap-x-4">
                            <div class="d-flex flex-column">
                                {{ address.attributes.city }}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-center gap-x-4">
                            <div class="d-flex flex-column">
                                {{ address.attributes.state }}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-center gap-x-4">
                            <div class="d-flex flex-column">
                                {{ address.attributes.email }}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex align-center gap-x-4">
                            <div class="d-flex flex-column">
                                {{ address.attributes.phone }}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <IconBtn @click="editItem(item)">
                                <VIcon icon="tabler-edit" />
                            </IconBtn>
                            <IconBtn @click="deleteItem(item)">
                                <VIcon icon="tabler-trash" />
                            </IconBtn>
                        </div>
                    </td>
                </tr>
                </tbody>



            </VTable>
        </VCard>
    </section>
</template>

