<template>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" style="margin-left: 20px;" href="#">LaravelVue - Instagram</a>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Alvian</a>
                </li>
                <li class="nav-item active">
                    <router-link class="nav-link"   :to="{ name: 'home' }">
                        Home
                    </router-link>
                </li>
                <li class="nav-item active">
                    <router-link class="nav-link"   :to="{ name: 'search' }">
                        Search
                    </router-link>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>

            </ul>

        </div>
    </nav>
</template>
