<template>
    <div class="alert alert-danger" v-if="error" role="alert">
        {{ error }}
    </div>

    <div v-if="success" class="alert alert-success alert-has-icon alert-dismissible show fade">
        <div class="alert-icon"><i class="icon fas fa-check"></i></div>
        <div class="alert-body">
            {{ success }}
        </div>
    </div>

    <div v-if="danger" class="alert alert-danger alert-has-icon alert-dismissible show fade">
        <div class="alert-icon"><i class="icon fas fa-check"></i></div>
        <div class="alert-body">
            {{ danger }}
        </div>
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
