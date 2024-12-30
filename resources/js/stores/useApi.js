import {defineStore} from 'pinia'
import Axios from '../composables/Axios'

const API_VERSION = 'v1'

export const useApiStore = defineStore('data', {
    state: () => {
        return {
            elements: [],
            meta: [],
            links: [],
            loading: false,
            company: {},
            submitting: false
        }
    },
    actions: {
        async getData(url,params) {
            this.loading = true
            try {
                const response =
                    await Axios.get(
                        API_VERSION + '/' + url,
                        {
                                params: params
                            }
                        )
                this.elements = response.data.data
                this.meta = response.data.meta
                this.links = response.data.links
                return this.data
            } catch (ex) {
                return Promise.reject(ex.response.statusText)
            } finally {
                this.loading = false
            }
        },
        async getElement(id) {
            this.loading = true
            try {
                const response = await Axios.get(`todos/${id}`)
                this.element = response.data.element
                return this.element
            } catch (ex) {
                return Promise.reject(ex.response.statusText)
            } finally {
                this.loading = false
            }
        },
        async updateTodo(id, todo) {
            this.submitting = true
            try {
                const response = await Axios.put(`todos/${id}`, todo)
                return response.data
            } catch (ex) {
                const error = {status: ex.response.status, message: ex.response.data.error}
                return Promise.reject(error)
            } finally {
                this.submitting = false
            }
        },
        async addTodo(todo) {
            this.submitting = true
            try {
                const response = await Axios.post(`todos/`, todo)
                return response.data
            } catch (ex) {
                const error = {status: ex.response.status, message: ex.response.data.error}
                return Promise.reject(error)
            } finally {
                this.submitting = false
            }
        },
        async deleteTodo(id) {
            this.submitting = true
            try {
                const response = await Axios.delete(`todos/${id}`)
                return response.data
            } catch (ex) {
                const error = {status: ex.response.status, message: ex.response.data.error}
                return Promise.reject(error)
            } finally {
                this.submitting = false
            }
        },
        async changeCompletedStatus(id, todo) {
            this.submitting = true
            try {
                const response = await Axios.put(`todos/completed/${id}`, todo)
                return response.data
            } catch (ex) {
                const error = {status: ex.response.status, message: ex.response.data.error}
                return Promise.reject(error)
            } finally {
                this.submitting = false
            }
        }
    },
    getters: {
        all_elements(state) {
            return state.elements.map((element) => {
                return {
                    id: element.id,
                    name: element.attributes.name,
                    created: element.attributes.created.human,
                }
            })
        }
    }
})