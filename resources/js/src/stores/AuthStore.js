import { defineStore } from 'pinia'
import authApi from "@/src/api/authApi.js";
import axios from "axios";

const csrf = () => axios.get(`${import.meta.env.VITE_API_URL}/sanctum/csrf-cookie`)

export const AuthStore = defineStore('AuthStore', {
    state: () => ({
        user: [],
        loading:false,
        if_authenticated:false,
    }),
    getters: {
    },
    actions: {
        async loginUser(userForm) {

            this.loading = true

            const { email, password } = userForm;
            let form_data = new FormData();

            form_data.append('email', email);
            form_data.append('password', password);

            try {

                await csrf()
                await authApi.post('auth/login', form_data);


                const data = await authApi.get('/api/user')
                this.user = data.data;
                this.if_authenticated=true;

                return { ok: true };
            } catch (error) {

                console.log(error)
                return { ok: false, message: error.response.data.message };
            } finally {
                // loader
                this.loading = false;
            }
        },

        async userLogout()
        {
            try {
                this.loading=true

                await authApi.post('/logout')
                this.if_authenticated=false
                this.user=[]
                return {ok:true}
            } catch (error) {
                console.log(error)
                return {ok:false}
            }finally{

                this.loading=false
            }

        },

        async CheckAuth()
        {
            this.loading=true
            try {


                const data = await authApi.get('api/user')
                this.user = data.data;
                this.if_authenticated=true;

                return { ok: true };
            } catch (error) {

                return { ok: false  };
            }finally {

                this.loading=false
            }
        }
    },
})
