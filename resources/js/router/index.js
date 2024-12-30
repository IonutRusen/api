import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'
import { hasToken } from '../composables/Token'
import Dashboard from "@/views/admin/Dashboard.vue";
import Settings from "@/views/admin/Settings.vue";
import Tables from "@/views/admin/Tables.vue";
import Maps from "@/views/admin/Maps.vue";
import Admin from "@/layouts/Admin.vue";
import Auth from "@/layouts/Auth.vue";
import Landing from "@/views/Landing.vue";
import Profile from "@/views/Profile.vue";
import Index from "@/views/Index.vue";


import Login from "@/views/auth/Login.vue";
import Register from "@/views/auth/Register.vue";
import CompanyListComponent from "@/components/Company/CompanyListComponent.vue";

const routeAuthGuard = (to, from, next) => {
    const isLoggedIn = useAuthStore().user_information.isLoggedIn && hasToken()
    if (isLoggedIn) {
        next()
    } else {
        next('/')
    }
}
const redirectIfAlredyLoggedIn = (to, from, next) => {
    const isLoggedIn = useAuthStore().user_information.isLoggedIn && hasToken()
    if (isLoggedIn) {
        next('admin/dashboard')
    } else {
        next()
    }
}

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes : [
        {
            path: "/admin",
            redirect: "/admin/dashboard",
            component: Admin,
            children: [
                {
                    path: '/admin/companies',
                    name: 'login',
                    component: CompanyListComponent,
                    beforeEnter: routeAuthGuard
                },
                {
                    path: "/admin/dashboard",
                    component: Dashboard,
                    name: "admin.dashboard",
                    beforeEnter: routeAuthGuard
                },
                {
                    path: "/admin/settings",
                    component: Settings,
                    beforeEnter: routeAuthGuard
                },
                {
                    path: "/admin/tables",
                    component: Tables,
                    beforeEnter: routeAuthGuard
                },
                {
                    path: "/admin/maps",
                    component: Maps,
                    beforeEnter: routeAuthGuard
                },
            ],
        },
        {
            path: "/auth",
            redirect: "/auth/login",
            component: Auth,
            children: [
                {
                    path: "/auth/login",
                    component: Login,
                    name: "auth.login",
                    beforeEnter: redirectIfAlredyLoggedIn
                },
                {
                    path: "/auth/register",
                    component: Register,
                    beforeEnter: redirectIfAlredyLoggedIn
                },
            ],
        },
        {
            path: "/landing",
            component: Landing,
        },
        {
            path: "/profile",
            component: Profile,
        },
        {
            path: "/",
            component: Index,
        },
        { path: "/:pathMatch(.*)*", redirect: "/" },
    ]
})
export default router