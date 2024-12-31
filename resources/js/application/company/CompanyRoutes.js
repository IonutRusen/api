const emailRouteComponent = () => import('@/pages/apps/email/index.vue')
const companiesList = () => import('./CompanyIndex.vue')
const facilityCreate = () => import('./FacilityCreate.vue')
const facilityEdit = () => import('./FacilityEdit.vue')

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
    path: '/dashboardss/logistics',
    name: 'dashboards-logistics',
    component: () => import('@/pages/apps/logistics/dashboard.vue'),
  },
  {
    path: '/companies',
    name: 'companies-list',
    component: companiesList,
  },
  {
    path: '/companies/create',
    name: 'companies-create',
    component: facilityCreate,
  },
  {
    path: '/companies/edit/:id',
    name: 'companies-edit',
    component: facilityEdit,
  },
]
