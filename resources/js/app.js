import './bootstrap';

import { createApp } from 'vue/dist/vue.esm-bundler.js';
import Welcome from './components/Welcome.vue'

const app = createApp({})

app.component('welcome', Welcome)

app.mount('#app')
