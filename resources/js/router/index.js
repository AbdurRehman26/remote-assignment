import { createRouter, createWebHistory } from 'vue-router'

import Resources from '../components/resources/List.vue'

const routes = [
    {
        path: '/',
        name: 'home',
        component: Resources
    },
    {
        path: '/admin',
        name: 'admin',
        component: Resources
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
