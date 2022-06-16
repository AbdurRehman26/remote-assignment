import './bootstrap';
require('alpinejs');

import { createApp } from 'vue'
import router from './router'

import MainApp from './Main.vue';


createApp({
    components: {
        MainApp
    }
}).use(router).mount('#app')
