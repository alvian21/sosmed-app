<template>
    <base-template>

        <div class="container" style="margin-top: 50px;">

            <div class="row mt-3">

                <div class="col-md-4">
                    <img class="rounded-circle" src="/user.png" alt="Generic placeholder image" width="140"
                        height="140">
                    <h2>{{ userData.name }}</h2>
                    <div class="row">
                        <div class="col-md-4">
                            {{ userData.post_count }} Post
                        </div>
                        <div class="col-md-4">
                            {{ userData.follower }} Follower
                        </div>
                        <div class="col-md-4">
                            {{ userData.following }} Following
                        </div>
                    </div>
                    <button type="button" v-on:click="onFollow()" :class="class_follow">
                        {{ status_follow? 'Followed': 'Follow' }}
                    </button>


                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4" v-for="(dataPost, index) in post" :key="index">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" alt="Thumbnail [100%x225]" v-bind:src="getImgUrl(dataPost.image)"
                            style="height: 225px; width: 100%; display: block;" data-holder-rendered="true">
                        <div class="card-body">
                            <button type="button" v-on:click="onLike(dataPost.id)" class="btn btn-info">
                                {{ dataPost.liked ? 'Unlike' : 'Like' }}
                            </button>
                            <p class="card-text">{{ dataPost.post_like_count }} Likes.</p>
                            <p class="card-text">{{ dataPost.description }}.</p>
                            <ul>
                                <li v-for="(comment, indexComment) in dataPost.post_comment">
                                    ({{ comment.user.name }}) {{ comment.description }}
                                </li>
                            </ul>
                            <div class="d-flex justify-content-between align-items-center">
                                <form v-on:submit.prevent="onComment(dataPost.id)">
                                    <div class="form-group">
                                        <label>Commment</label>
                                        <textarea v-model="comment" class="form-control comment" name="comment"
                                            id="comment" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                </form>


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

export default {
    data() {
        return {
            userData: {
                id: null,
                name: '',
                post: 0,
                follower: 0,
                following: 0,
                post_count: 0,

            },
            status_follow: false,
            class_follow: 'btn btn-primary w-100',
            post: [],
            comment: ''
        }
    },
    components: {
        BaseTemplate
    },
    mounted() {
        this.getProfile()


    },
    methods: {
        getProfile() {
            this.axios.get('/api/profile/' + this.$route.params.username)
                .then(response => {
                    console.log(response);
                    this.userData.id = response.data.data.id;
                    this.userData.name = response.data.data.name;
                    this.userData.follower = response.data.data.follower_count;
                    this.userData.following = response.data.data.following_count;
                    this.status_follow = response.data.data.status_follow;
                    this.userData.post_count = response.data.data.post_count;
                    if (this.status_follow) {
                        this.class_follow = 'btn btn-success w-100'
                    }

                    this.getPost()
                }, (this))
        },
        onFollow() {
            this.axios.post('/api/follow', {
                follow_user_id: this.userData.id
            }).then(response => {
                if (response.data.data.status_follow) {
                    this.class_follow = 'btn btn-success w-100'
                } else {
                    this.class_follow = 'btn btn-primary w-100'
                }

                this.status_follow = response.data.data.status_follow

                this.getProfile()
            }, (this))
        },
        getPost() {
            this.post = []
            this.axios.get("/api/post", {
                params: {
                    user_id: this.userData.id
                }
            }).then(response => {

                if (response.data.success) {

                    for (let index = 0; index < response.data.data.length; index++) {
                        const element = response.data.data[index];
                        this.post.push(element)
                    }

                    this.userData.post_count = response.data.data.length
                }
            }, (this))
        },
        onComment(id) {
            this.axios.post("/api/comment", {
                comment: this.comment,
                id: id
            }).then(response => {
                this.comment = null;
                this.getPost()
            })
        },
        onLike(id){
            this.axios.post("/api/like", {
                id: id
            }).then(response => {
                this.getPost()
            })
        },
        getImgUrl(src) {
            return "/storage/" + src
        },
    }
}
</script>
