<template>
    <base-template>

        <div class="container" style="margin-top: 50px;">


            <div class="row mt-3">
                <div class="col-md-8">
                    <h2>Post Something</h2>
                    <alert :error="formError" :success="formSuccess" />
                    <form v-on:submit.prevent="addPost()" id="addPostForm">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" ref="description" v-model="addPostData.description" required
                                id="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <br>
                            <input type="file" required v-on:change="onChangeFileUpload()" ref="file"
                                class="form-control-file" id="image">
                        </div>

                        <button type="submit" class="btn btn-primary mt-2 btn-block w-100">Post</button>
                    </form>

                </div>
                <div class="col-md-4">
                    <img class="rounded-circle"
                        src="/user.png"
                        alt="Generic placeholder image" width="140" height="140">
                    <h2>{{ userData? userData.name : '' }}</h2>
                    <div class="row">
                        <div class="col-md-4">
                            {{ post_count }} Post
                        </div>
                        <div class="col-md-4">
                            {{ follower }} Follower
                        </div>
                        <div class="col-md-4">
                            {{ following }} Following
                        </div>
                    </div>

                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4" v-for="(dataPost, index) in post" :key="index">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" alt="Thumbnail [100%x225]"
                            style="height: 225px; width: 100%; display: block;" v-bind:src="getImgUrl(dataPost.image)"
                            data-holder-rendered="true">
                        <div class="card-body">
                            <p class="card-text">{{ dataPost.description }}.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" v-on:click="deletePost(dataPost.id)"
                                        class="btn btn-sm btn-outline-secondary">Delete</button>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>



    </base-template>
</template>

<script>
import BaseTemplate from '../base.vue'

import { mapGetters, mapActions } from "vuex";

import alert from '../include/alert.vue'


export default {
    data() {
        return {
            userData: {
                name: ""
            },
            post: [],
            addPostData: {
                description: null,
                image: null
            },
            post_count: 0,
            follower:0,
            following:0,
            formError: '',
            formSuccess: ''
        }
    },
    components: {
        BaseTemplate,
        alert
    },
    mounted() {
        if (!this.$store.getters['auth/user']) {
            this.getUserData().then(() => {
                this.userData = this.$store.getters['auth/user']
                this.follower = this.userData.follower_count;
                this.following = this.userData.following_count;
            }, (this))


        } else {
            this.userData = this.$store.getters['auth/user']
            this.follower = this.userData.follower_count;
                this.following = this.userData.following_count;
        }


        this.getPost()
    },
    computed: {
        ...mapGetters("auth", ["user"]),

    },
    methods: {
        ...mapActions("auth", ["getUserData"]),
        addPost() {

            var form = new FormData();
            form.append('description', this.addPostData.description);
            form.append('image', this.addPostData.image);

            this.axios({
                method: "POST",
                url: '/api/post',
                data: form,
                config: { headers: { 'Content-Type': 'multipart/form-data' } }
            })
                .then(response => {
                    this.formError = '';
                    if (response.data.success) {
                        this.formSuccess = response.data.message

                        this.addPostData.description = null;
                        this.$refs.file.value = null;

                        this.getPost()

                    }

                    setTimeout(() => {
                        this.formSuccess = ''
                    }, 3000);
                })
                .catch((error) => {
                    if (error.response && error.response.data) {
                        this.formError = error.response.data.message
                    }

                });
        },
        onChangeFileUpload() {
            this.addPostData.image = this.$refs.file.files[0];
        },
        getPost() {
            this.post = []
            this.axios.get("/api/post",{params:{
                status:true
            }}).then(response => {
                if (response.data.success) {

                    for (let index = 0; index < response.data.data.length; index++) {
                        const element = response.data.data[index];
                        this.post.push(element)
                    }

                    this.post_count = response.data.data.length
                }
            }, (this))
        },
        deletePost(id) {
            this.axios.delete('/api/post/' + id).then(response => {
                if (response.data.success) {
                    this.formSuccess = response.data.message
                    this.getPost()
                }

                setTimeout(() => {
                    this.formSuccess = ''
                }, 3000);

            })
        },
        getImgUrl(src) {
            return "/storage/" + src
        },
    }
}
</script>
