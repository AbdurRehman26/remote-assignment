import './bootstrap';
require('alpinejs');

import { createApp } from 'vue'
import router from './router'

import MainApp from './Main.vue';
import MainNav from './components/shared/Nav.vue';


createApp({
    components: {
        MainApp,
        MainNav
    }
}).use(router).mount('#app')
