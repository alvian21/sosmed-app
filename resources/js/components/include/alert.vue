<template>
    <div class="alert alert-danger" v-if="error" role="alert">
        {{ error }}
    </div>
    <div class="alert alert-success" v-if="success" role="alert">
        {{ success }}
    </div>

</template>

<script>
export default {
    props: {
        error: {
            type: String,
            required: false
        },
        success: {
            type: String,
            required: false
        },
        danger: {
            type: String,
            required: false
        },
    }
};

</script>
