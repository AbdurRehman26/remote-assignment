import { createRouter, createWebHistory } from 'vue-router'

import Resources from '../components/resources/List.vue'
import CreateResource from '../components/resources/Create'

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
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
