import { createRouter, createWebHistory } from "vue-router";

import loginPage from "../components/auth/login.vue"

import registerPage from "../components/auth/register.vue"

import homePage from "../components/home/index.vue"

import searchPage from "../components/search/index.vue"

import profilePage from "../components/profile/index.vue"

import notFound from '../components/notFound.vue'

const routes = [
    {
        path: '/login',
        name: "login",
        component: loginPage
    },

    {
        path: '/register',
        name: "register",
        component: registerPage
    },

    {
        path: '/',
        name: "home",
        component: homePage,
        meta:{
            requireAuth:true
        }
    },

    {
        path: '/search',
        name: "search",
        component: searchPage,
        meta:{
            requireAuth:true
        }
    },

    {
        path: '/profile/:username',
        name: "profile",
        component: profilePage,
        meta:{
            requireAuth:true
        }
    },

    // not found
    {
        path: '/:pathMatch(.*)*',
        component: notFound
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
})


router.beforeEach((to, from, next) => {
    if (to.name !== "login" && !localStorage.getItem("authToken") && to.name !== "register") {
        next({ name: "login" });
    } else if (to.name === "login" && localStorage.getItem("authToken")) {
        next({ name: "home" });
    } else {
        next();
    }

});


export default router;
