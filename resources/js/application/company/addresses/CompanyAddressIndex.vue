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
        title: 'Website',
        key: 'website',
        sortable: true,
    },
    {
        title: 'Created At',
        key: 'created_at',
        sortable: false,
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
                                <h6 class="text-base">
<!--                                    <RouterLink
                                        :to="{ name: 'companies-edit', params: { id: item.id } }"
                                        class="font-weight-medium text-link"
                                    >
                                        {{ item.attributes.name }}
                                    </RouterLink>-->
                                </h6>
                            </div>
                        </div>
                    </td>
                </tr>
                </tbody>
<!--                <template #item.name="{ item }">
                    <div class="d-flex align-center gap-x-4">
                        <div class="d-flex flex-column">
                            <h6 class="text-base">
                                <RouterLink
                                    :to="{ name: 'companies-edit', params: { id: item.id } }"
                                    class="font-weight-medium text-link"
                                >
                                    {{ item.attributes.name }}
                                </RouterLink>
                            </h6>
                        </div>
                    </div>
                </template>
                <template #item.website="{ item }">
                    <div class="d-flex align-center gap-x-4">
                        <div class="d-flex flex-column">
                            <h6 class="text-base">
                                {{ item.attributes.website }}
                            </h6>
                        </div>
                    </div>
                </template>
                <template #item.created_at="{ item }">
                    <div class="d-flex align-center gap-x-4">
                        <div class="d-flex flex-column">
                            <h6 class="text-base">
                                {{ item.attributes.created.human }}
                            </h6>
                        </div>
                    </div>
                </template>

                <template #item.actions="{ item }">
                    <VBtn
                        icon="tabler-trash"
                        class="me-2"
                        variant="tonal"
                        size="x-small"
                        color="error"
                        rounded
                        @click="deleteCompany(item.id)"
                    />

                    <VBtn
                        :to="{ name: 'companies-edit', params: { id: item.id } }"
                        icon="tabler-edit"
                        variant="tonal"
                        size="x-small"
                        color="primary"
                        rounded
                    />

                    <VDialog
                        v-model="deleteDialog"
                        max-width="500px"
                    >
                        <VCard title="Are you sure you want to delete this user?">
                            <VCardText>
                                <div class="d-flex justify-center gap-4">
                                    <VBtn
                                        color="error"

                                        variant="outlined"
                                        @click="closeDelete"
                                    >
                                        Cancel
                                    </VBtn>
                                    <VBtn
                                        color="success"
                                        variant="elevated"
                                        @click="confirmDelete(item.id)"
                                    >
                                        OK
                                    </VBtn>
                                </div>
                            </VCardText>
                        </VCard>
                    </VDialog>
                </template>-->


            </VTable>
        </VCard>
    </section>
</template>

