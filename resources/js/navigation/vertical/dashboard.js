export default [
  {
    title: 'Dashboards',
    icon: { icon: 'tabler-smart-home' },
    children: [
      {
        title: 'Logistics',
        to: 'dashboards-logistics',
      },
    ],
    badgeContent: '5',
    badgeClass: 'bg-error',
  },
  {
    title: 'Front Pages',
    icon: { icon: 'tabler-files' },
    children: [
      {
        title: 'Landing',
        to: 'front-pages-landing-page',
        target: '_blank',
      },
      {
        title: 'Pricing',
        to: 'front-pages-pricing',
        target: '_blank',
      },

    ],
  },
]
