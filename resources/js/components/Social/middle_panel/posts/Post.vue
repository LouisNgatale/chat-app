<template>
<div>
    <!--   Post   -->
    <div v-for="post in posts" class="post py-2 mt-4 mb-4 container-fluid text-white">
        <!--   Header   -->
        <div class="row pt-3 pb-3 pl-3 pr-3 ">
            <div class="col-9">
                <div class="row align-items-center">
                    <img src="images/blank.png" class="rounded-circle dp  " alt="">
                    <div class="col pl-2">
                        <p class="m-0">Username</p>
                        <p class="m-0">5hrs</p>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <img src="/images/menu_circles.png" class="img-fluid float-right" alt="">
            </div>
        </div>

        <!--   Caption   -->
        <div class="row">
            <div class="col pb-2">
                {{ post.caption }}
            </div>
        </div>

        <!--   Picture   -->
        <div class="row">
            <div class="col p-0">
                <img :src="'/storage/' + post.media" class="img-fluid" alt="">
            </div>
        </div>

        <!--   Actions   -->
        <div class="row">
            <div class="col p-0">
                <hr>
            </div>
        </div>

        <div class="row align-items-center justify-content-start">
                <div class="col">
                    <div class="row">
                        <div class="col pr-2">
                            <img src="images/comment.png" class="img-fluid" alt="">
                            <span>70</span>
                        </div>
                        <div class="col pr-2 pl-0">
                            <img src="images/like.png" class="img-fluid" alt="">
                            <span>20</span>
                        </div>
                        <div class="col pr-2 pl-0">
                            <img src="images/share.png" class="img-fluid" alt="">
                            <span>30</span>
                        </div>
                    </div>
                </div>
        </div>

            <div class="row">
                <div class="col p-0">
                    <hr>
                </div>
            </div>

        <!--   Comments   -->
        <div class="row">
            <comment v-for="comment in post.comments" :key="comment" v-bind:comment="comment"></comment>
        </div>

        <!--   Add Comment   -->
        <div class="row align-items-center my-2">

            <!--   Input new Post   -->
            <div class="ml-2">
                <img :src="'/storage/' + displayImage" class="rounded-circle dp img-fluid" alt="">
            </div>
            <div class="col">
                <input type="text" v-model="caption" name="caption" class="float-left w-100 text-white" placeholder="Write new comment">
            </div>
        </div>
    </div>
</div>
</template>

<script>
import comment from "../comments/MainComment";
import {mapGetters} from "vuex";
export default {
name: "Post",
    components:{ comment },
    data(){
        return{
            posts: [],
        }

    },
    created() {
        axios.get('/posts')
            .then((response)=>{
                let posts = [];
                let array = response.data.data;

                response.data.data.forEach((x) => {
                    this.posts.push(x);
                })

            }).catch((error)=>{
            console.log(error);
        })
    },
    computed:{
        ...mapGetters([
            'displayImage',
            'userName'
        ]),
    }
}
</script>

<style lang="scss" scoped>
@import '../../../../../sass/variables';

.post{
    background: $bg_medium;
    border-radius: 5px;
}
.dp{
    height: 40px;
    width: auto;
}
input{
    border-radius: 10px;
    background: $border;
    border: none;
    padding: 5px 15px;
    color: $color;
    outline: none;
    width: 100%;
}
.dp{
    height: 40px;
}
hr{
    background: $border;
}

//Placeholder color
::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
    color: $sub_heading;
    opacity: 1; /* Firefox */
}

:-ms-input-placeholder { /* Internet Explorer 10-11 */
    color: $sub_heading;
}

::-ms-input-placeholder { /* Microsoft Edge */
    color: $sub_heading;
}
</style>
