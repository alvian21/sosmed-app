<template>
    <base-template>
        <div class="container" style="margin-top: 50px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">

                        <input type="text" class="form-control" name="search" id="search"
                            placeholder="Search People....">

                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-md-12">
                    <router-link :to="{name:'search'}">
                        <div class="card-body" style="border: 1px solid burlywood; border-radius: 10px;">
                            <div class="row justify-content-center">
                                <div style="display: inline-flex;">
                                    <img class="rounded-circle" src="/user.png" width="100" alt="Thumbnail [100%x225]">
                                    <h3 style="margin-top: 28px; margin-left: 10px;">Alvian (username)</h3>
                                </div>

                            </div>

                        </div>
                    </router-link>

                </div>
            </div>

        </div>
    </base-template>

</template>

<script>
import BaseTemplate from '../base.vue'

export default {
    components: {
        BaseTemplate
    }
}
</script>
