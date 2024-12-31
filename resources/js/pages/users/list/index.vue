<script setup>
import Swal from "sweetalert2"

const searchQuery = ref('')
const selectedStatus = ref()

const itemsPerPage = ref(10)
const page = ref(1)
const sortBy = ref()
const orderBy = ref()
const selectedRows = ref([])
const selectedUser = ref(null)
const deleteDialog = ref(false)

const updateOptions = options => {
  sortBy.value = options.sortBy[0]?.key
  orderBy.value = options.sortBy[0]?.order
}

const headers = [
  {
    title: 'User',
    key: 'user',
  },
  {
    title: 'Status',
    key: 'status',
  },
  {
    title: 'Actions',
    key: 'actions',
    sortable: false,
  },
]

const {
  data: usersData,
  execute: fetchUsers,
} = await useApi(createUrl('/users', {
  method: 'GET',
  query: {
    q: searchQuery,
    status: selectedStatus,
    itemsPerPage,
    page,
    sortBy,
    orderBy,
  },
}))

const users = computed(() => usersData.value.data.users)
const totalUsers = computed(() => usersData.value.data.totalUsers)

const status = [
  {
    title: 'Active',
    value: 'active',
  },
  {
    title: 'Inactive',
    value: 'inactive',
  },
]

const resolveUserStatusVariant = stat => {
  console.log(stat)
  if (stat === true)
    return 'success'
  if (stat === 0)
    return 'secondary'

  return 'primary'
}

const isAddNewUserDrawerVisible = ref(false)
const isEditUserDrawerVisible = ref(false)

const editUser = async id => {
  selectedUser.value = id
  isEditUserDrawerVisible.value = true
}

const deleteUser = async id => {
  deleteDialog.value = true
}

const closeDelete = () => {
  deleteDialog.value = false
}

const confirmDelete = async id => {
  try {
    await $api(`/users/${id}`, {
      method: 'DELETE',
    })

    deleteDialog.value = false
    await fetchUsers()
    await Swal.fire(
      'User deleted',
      'User has been deleted successfully.',
      'success',
    )
  } catch (error) {
    console.error(error)
  }
}
</script>

<template>
  <section>
    <VCard class="mb-6">
      <VCardItem class="pb-4">
        <VCardTitle>Filters</VCardTitle>
      </VCardItem>

      <VCardText>
        <VRow>
          <VCol
            cols="12"
            sm="4"
          >
            <AppSelect
              v-model="selectedStatus"
              placeholder="Select Status"
              :items="status"
              clearable
              clear-icon="tabler-x"
            />
          </VCol>
        </VRow>
      </VCardText>

      <VDivider />

      <VCardText class="d-flex flex-wrap gap-4">
        <div class="me-3 d-flex gap-3">
          <AppSelect
            :model-value="itemsPerPage"
            :items="[
              { value: 10, title: '10' },
              { value: 25, title: '25' },
              { value: 50, title: '50' },
              { value: 100, title: '100' },
              { value: -1, title: 'All' },
            ]"
            style="inline-size: 6.25rem;"
            @update:model-value="itemsPerPage = parseInt($event, 10)"
          />
        </div>
        <VSpacer />

        <div class="app-user-search-filter d-flex align-center flex-wrap gap-4">
          <div style="inline-size: 15.625rem;">
            <AppTextField
              v-model="searchQuery"
              placeholder="Search User"
            />
          </div>

          <VBtn
            prepend-icon="tabler-plus"
            @click="isAddNewUserDrawerVisible = true"
          >
            Add New User
          </VBtn>
        </div>
      </VCardText>

      <VDivider />

      <VDataTableServer
        v-model:items-per-page="itemsPerPage"
        v-model:page="page"
        :items="users"
        item-value="id"
        :items-length="totalUsers"
        :headers="headers"
        class="text-no-wrap"
        @update:options="updateOptions"
      >
        <template #item.user="{ item }">
          <div class="d-flex align-center gap-x-4">
            <div class="d-flex flex-column">
              <h6 class="text-base">
                <RouterLink
                  :to="{ name: 'apps-user-view-id', params: { id: item.id } }"
                  class="font-weight-medium text-link"
                >
                  {{ item.name }}
                </RouterLink>
              </h6>
              <div class="text-sm">
                {{ item.email }}
              </div>
            </div>
          </div>
        </template>

        <template #item.status="{ item }">
          <VChip
            :color="resolveUserStatusVariant(item.status)"
            size="small"
            label
            class="text-capitalize"
          >
            {{ item.status ? 'active' : 'inactive' }}
          </VChip>
        </template>

        <template #item.actions="{ item }">
          <VBtn
            icon="tabler-trash"
            class="me-2"
            variant="tonal"
            size="x-small"
            color="error"
            rounded
            @click="deleteUser"
          />

          <VBtn
            icon="tabler-edit"
            variant="tonal"
            size="x-small"
            color="primary"
            rounded
            @click="editUser(item.id)"
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
        </template>

        <template #bottom>
          <TablePagination
            v-model:page="page"
            :items-per-page="itemsPerPage"
            :total-items="totalUsers"
          />
        </template>
      </VDataTableServer>
    </VCard>
  </section>
</template>
