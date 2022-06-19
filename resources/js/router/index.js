import { createRouter, createWebHistory } from 'vue-router'

import Resources from '../components/resources/List.vue'
import CreateResource from '../components/resources/Create'
import EditResource from '../components/resources/Edit'

const routes = [
    {
        path: '/',
        name: 'resource.index',
        component: Resources
    },
    {
        path: '/resource/create',
        name: 'resource.create',
        component: CreateResource
    },
    {
        path: '/resource/:id/edit',
        name: 'resource.edit',
        component: EditResource,
        props: true
    },
    {
        path: '/admin',
        name: 'resource.admin',
        component: Resources
    },

];

export default createRouter({
    history: createWebHistory(),
    routes
})
