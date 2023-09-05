import {RouteConfig} from "vue-router";

export default <RouteConfig[]>[
    {
        path: '/',
        component: () => import('../views/HistoryView.vue'),
    },
    {
        path: '/report/:id',
        name: 'report',
        component: () => import('../views/ReportView.vue'),
        props: true,
    },
    {
        path: '/404',
        component: () => import('../views/404View.vue'),
    },
    {
        path: '*',
        redirect: '/404'
    }
]