import './bootstrap';

import { createApp } from 'vue'
const app = createApp({});

import Main from './src/Main.vue';

app.component('main-app', Main)

app.mount('#app')
