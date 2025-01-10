import CompanyAddressCreate from "@/application/company/addresses/CompanyAddressDetails.vue";

const emailRouteComponent = () => import('@/pages/apps/email/index.vue')
const companiesList = () => import('./CompanyIndex.vue')
const companyCreate = () => import('./CompanyCreate.vue')
const companyEdit = () => import('./CompanyEdit.vue')

export const companyRoutes = [
    {
        path: '/apps/email/filter/:filter',
        name: 'apps-email-filter',
        component: emailRouteComponent,
        meta: {
            navActiveLink: 'apps-email',
            layoutWrapperClasses: 'layout-content-height-fixed',
        },
    },
    {
        path: '/dashboards/logistics',
        name: 'dashboards-logistics',
        component: () => import('@/pages/apps/logistics/dashboard.vue'),
    },
    {
        path: '/companies/list',
        name: 'companies-list',
        component: companiesList,
    },
    {
        path: '/companies/create',
        name: 'companies-create',
        component: companyCreate,
    },
    {
        path: '/companies/edit/:id',
        name: 'companies-edit',
        component: companyEdit,

    },
]
