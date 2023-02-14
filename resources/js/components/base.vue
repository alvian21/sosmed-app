<template>

    <navbar />
    <main role="main">
        <slot></slot>
    </main>
</template>

<script>
import navbar from './include/navbar.vue'

export default {
    template:"base-template",
    components:{
        navbar
    }
}
</script>
