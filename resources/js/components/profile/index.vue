<template>
    <base-template>

        <div class="container" style="margin-top: 50px;">

            <div class="row mt-3">

                <div class="col-md-4">
                    <img class="rounded-circle"
                        src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                        alt="Generic placeholder image" width="140" height="140">
                    <h2>{{ userData.name }}</h2>
                    <div class="row">
                        <div class="col-md-4">
                            5 Post
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
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"
                            data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                            alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                            src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1864e232763%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1864e232763%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.7265625%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                            data-holder-rendered="true">
                        <div class="card-body">
                            <button type="button" class="btn btn-info">Like</button>
                            <p class="card-text">100 Likes.</p>
                            <p class="card-text">Description.</p>
                            <ul>
                                <li>(Alvian) Mantap</li>
                            </ul>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Commment</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                                <button type="button" class="btn btn-primary">Submit</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"
                            data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                            alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                            src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1864e232768%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1864e232768%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.7265625%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                            data-holder-rendered="true">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"
                            data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;fg=eceeef&amp;text=Thumbnail"
                            alt="Thumbnail [100%x225]" style="height: 225px; width: 100%; display: block;"
                            src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22348%22%20height%3D%22225%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20348%20225%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1864e23276b%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A17pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1864e23276b%22%3E%3Crect%20width%3D%22348%22%20height%3D%22225%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%22116.7265625%22%20y%3D%22120.3%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                            data-holder-rendered="true">
                        <div class="card-body">
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to
                                additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                </div>
                                <small class="text-muted">9 mins</small>
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

            },
            status_follow: false,
            class_follow: 'btn btn-primary w-100'
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

                    if (this.status_follow) {
                        this.class_follow = 'btn btn-success w-100'
                    }
                }, (this))
        },
        onFollow() {
            this.axios.post('/api/follow', {
                follow_user_id: this.userData.id
            }).then(response => {
                if(response.data.data.status_follow){
                    this.class_follow = 'btn btn-success w-100'
                }else{
                    this.class_follow = 'btn btn-primary w-100'
                }

                this.status_follow = response.data.data.status_follow

                this.getProfile()
            },(this))
        }
    }
}
</script>
