import { createRouter, createWebHistory } from 'vue-router'

import Resources from '../components/resources/List.vue'
import CreateResource from '../components/resources/Create'
import EditResource from '../components/resources/Edit'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Resources
    },
    {
        path: '/admin',
        name: 'admin',
        component: CreateResource
    },
    {
        path: '/resource/:id/edit',
        name: 'resource.edit',
        component: EditResource,
        props: true
    },

];

export default createRouter({
    history: createWebHistory(),
    routes
})
