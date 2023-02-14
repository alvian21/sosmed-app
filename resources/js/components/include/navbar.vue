<template>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" style="margin-left: 20px;" href="#">LaravelVue - Instagram</a>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">{{ user.name }}</a>
                </li>
                <li class="nav-item active">
                    <router-link class="nav-link" :to="{ name: 'home' }">
                        Home
                    </router-link>
                </li>
                <li class="nav-item active">
                    <router-link class="nav-link" :to="{ name: 'search' }">
                        Search
                    </router-link>
                </li>
                <li class="nav-item">

                    <a class="nav-link" v-on:click="logout" href="#">Logout</a>
                </li>

            </ul>

        </div>
    </nav>
</template>


<script>

import { mapGetters, mapActions } from "vuex";

export default {
    data() {
        return {
            user: {
                name: null
            }
        }
    },
    mounted() {
        this.$store.commit("setErrors", {});
        this.getUserData();
        this.user = this.$store.getters['auth/user']

    },
    computed: {
        ...mapGetters(["errors"])
    },
    methods: {
        ...mapActions("auth", ["sendLogoutRequest", "getUserData"]),

        logout: function () {
            this.sendLogoutRequest()
        }
    }
}
</script>
