<template>
    <div
        class="w-full"
        :class="['bg-white' ]"
    >
    <LoadingComponent v-if="dataFromStore.loading" />
    <template v-else>
        <div class="block w-full overflow-x-auto py-3">
        <v-data-table-server
            v-model:items-per-page="itemsPerPage"
            :items="dataFromStore.all_elements"
            :items-length="dataFromStore.meta.total"
            :loading="dataFromStore.loading"
            item-value="name"
            :pagination.sync="dataFromStore.links"
            @update:options="loadItems"
            class="w-full bg-transparent border-collapse"
        ></v-data-table-server>

        </div>

    </template>
    </div>
</template>

<script setup>
import LoadingComponent from '../LoadingComponent.vue'
import { useApiStore } from '@/stores/useApi'
import { ref } from 'vue'
import { onMounted } from 'vue'
import { ErrorToast, SuccessToast } from '@/composables/Toast'
const dataFromStore = useApiStore()
const itemsPerPage = ref(5)
const handleDelete = (id, index) => {
    dataFromStore
        .deleteTodo(id)
        .then((d) => {
            dataFromStore.data.splice(index, 1)
            SuccessToast(d.message)
        })
        .catch((e) => {
            ErrorToast(e.message)
        })
}

const loadItems = (options) => {
    dataFromStore.loading = true
    dataFromStore.getData('companies', options)
    dataFromStore.loading = false
}


onMounted(() => {
    dataFromStore.getData('companies', { page: 1, per_page: itemsPerPage.value })
})
</script>