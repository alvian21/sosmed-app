<template>
    <div id="wrapper">
        <div class="container">
            <div class="phone-app-demo"></div>
            <div class="form-data">
                <form action="">
                    <div class="logo">
                        <img src="/assets/images/logo.png" alt="" srcset="">
                    </div>
                    <input type="text" name="username" id="username" placeholder="Email">

                    <input type="password" name="password" id="password" placeholder="Password">
                    <button class="form-btn btn btn-primary" type="button"> Log in</button>


                </form>
                <div class="sign-up">
                    Don't have an account?
                    <router-link  :to="{ name: 'register' }">
                        Sign up
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
