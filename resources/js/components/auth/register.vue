<template>
    <div id="wrapper">
        <div class="container">
            <div class="phone-app-demo"></div>
            <div class="form-data">
                <alert :error="formError" />
                <form @submit.prevent="register">
                    <div class="logo">
                        <img src="/assets/images/logo.png" alt="" srcset="">
                    </div>
                    <input type="text" name="email" id="email" v-model="form.email" placeholder="Email">

                    <input type="text" name="username" id="username" v-model="form.username" placeholder="Username">

                    <input type="text" name="name" id="name" v-model="form.name" placeholder="Name">

                    <input type="password" name="password" v-model="form.password" id="password" placeholder="Password">

                    <input type="password" name="c_password" id="c_password" v-model="form.c_password"
                        placeholder="Confirmation Password">

                    <button class="form-btn btn btn-primary" type="submit">Sign Up</button>


                </form>
                <div class="sign-up">
                    Have an account?
                    <router-link :to="{ name: 'login' }">
                        Sign in
                    </router-link>
                </div>

            </div>
        </div>

        <footer>
            <div class="container">
                <nav class="footer-nav">
                    <ul>
                        <li>
                            <a href="#">About us</a>
                        </li>
                        <li>
                            <a href="#">Support</a>
                        </li>
                        <li>
                            <a href="#">Press</a>
                        </li>
                        <li>
                            <a href="#">Api</a>
                        </li>
                        <li>
                            <a href="#">Jobs</a>
                        </li>
                        <li>
                            <a href="#">Privacy</a>
                        </li>
                        <li>
                            <a href="#">Terms</a>
                        </li>
                        <li>
                            <a href="#">Directory</a>
                        </li>
                        <li>
                            <a href="#">Profiles</a>
                        </li>
                        <li>
                            <a href="#">Hashtags</a>
                        </li>
                        <li>
                            <a href="#">Languages</a>
                        </li>
                    </ul>
                </nav>
                <div class="copyright-notice">
                    &copy; 2023 Laravel - Instagram
                </div>
            </div>
        </footer>


    </div>
</template>

<style lang="scss" scoped>
@import '../../../css/style.scss';
</style>

<script>
import { mapGetters, mapActions } from "vuex";

import alert from '../include/alert.vue'

export default {

    components: {
        'alert': alert
    },
    data() {
        return {
            form: {
                email: '',
                username: '',
                name: '',
                password: '',
                c_password: ''
            },
            formError: ''
        }
    },
    mounted() {
        this.$store.commit("setErrors", {});
    },
    computed: {
        ...mapGetters(["errors"])
    },
    methods: {
        ...mapActions("auth", ["sendRegisterRequest"]),

        register: function () {

            this.sendRegisterRequest(this.form)
                .then((response) => {
                    this.$router.push({ name: "home" });
                })
                .catch((error) => {
                    if (error.response && error.response.data) {
                        this.formError = error.response.data.message
                    }

                });
        }
    }
}

</script>
