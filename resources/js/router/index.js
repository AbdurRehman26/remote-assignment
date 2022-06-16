import { createRouter, createWebHistory } from 'vue-router'

import Resources from '../components/resources/Main.vue'

const routes = [
    {
        path: '/',
        name: 'resources.index',
        component: Resources
    }
];

export default createRouter({
    history: createWebHistory(),
    routes
})
