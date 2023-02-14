import './bootstrap';

import { createApp } from 'vue';

import AppWrapper from './components/app.vue';

import VueAxios from 'vue-axios';

import router from "./router"

import axios from 'axios';

import store from "./store";

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'


router.beforeEach(function (to, from, next) {
    window.scrollTo(0, 0);
    next();
});

const app = createApp(AppWrapper)


axios.interceptors.response.use(
    response => response,
    error => {
        setTimeout(() => {
            if (error.response.status === 422) {
                store.commit("setErrors", error.response.data.errors);
            } else {
                store.commit("setErrors", error.response.data.data ? error.response.data.data : error);
                return Promise.reject(error);
            }
        }, 1000);
    }
);

axios.interceptors.request.use((config) => {

    config.headers.Authorization = `Bearer ${localStorage.getItem("authToken")}`;

    return config;
});


app.use(router)
app.use(store)
app.use(VueAxios, axios)
app.mount('#app')

