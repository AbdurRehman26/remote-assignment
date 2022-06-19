import './bootstrap';
require('alpinejs');

import { createApp } from 'vue'
import router from './router'

import MainNav from './components/shared/Nav.vue';

createApp({
    components: {
        MainNav
    }
}).use(router).mount('#app')
