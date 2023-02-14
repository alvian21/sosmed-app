import './bootstrap';

import { createApp } from 'vue';

import AppWrapper from './components/app.vue';

import VueAxios from 'vue-axios';

import router from "./router"

import axios from 'axios';

import store from "./store";

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


router.beforeEach(function(to, from, next) {
    window.scrollTo(0, 0);
    next();
});

const app = createApp(AppWrapper)


app.use(router)
app.use(store)
app.use(VueAxios, axios)
app.mount('#app')

