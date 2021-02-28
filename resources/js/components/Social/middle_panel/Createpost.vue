<template>
<div class="text-white new_post_container container-fluid p-2">
    <form action="/createPost" @submit.prevent="validate" enctype="multipart/form-data" id="form" method="post" ref="createPost">
        <!--   Top Row   -->
        <div class="row p-4 align-items-center justify-content-center">

            <!--   Profile Picture   -->
            <div class="col-md-2 pr-0">
                <img :src="'/storage/' + displayImage" class="rounded-circle w-50 img-fluid" alt="">
            </div>

            <!--   Input new Post   -->
            <div class="col-md-10 pl-0">
                <input type="text" v-model="caption" name="caption" class="float-left w-100 text-white" :placeholder="'What\'s on your mind, @' + userName +'?'">
            </div>

        </div>
        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>

        <!--   Bottom row   -->
        <div class="row align-items-center">
            <div class="col-4">
                <label class="row align-items-center" for="post_image">
                    <div class="col pr-1">
                        <img src="/images/addImage.png" class="float-right img-fluid add-photo" alt="">
                        <span class="float-right mr-2">Add Photo</span>
                    </div>
                </label>
                <input id="post_image" @change="receiveImage" class="d-none" type="file" name="post_image">

            </div>

            <div class="col-8">
<!--                <button class="btn btn-primary" @click="validate">Add post</button>-->
                <input type="submit" class="btn btn-primary" value="Add post" >
            </div>
        </div>
    </form>
</div>
</template>

import { mapState } from 'vuex';
import {mapActions} from 'vuex';
import {mapGetters} from 'vuex';
<script>
import {mapGetters} from "vuex";

export default {
name: "Createpost",
    data(){
        return{
            caption: "",
            image: ""
        }
    },
    methods:{
        validate(){
            let data = new FormData();
            data.append('image',this.image);
            data.append('caption', this.caption);

            if (!this.caption && this.image == null) {
                console.log("Empty");
            } else {
                axios.post("/createPost", data,{
                        headers:{
                            'content-type':'multipart/form-data'
                        }
                    }
                ).then((response) => {
                    console.log(response)
                }).catch((error) => {
                    console.log(error)
                });
            }
        },
        receiveImage:function (e){
            let image = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(image);
            reader.onload = e => {
                let  src = e.target.result;
                this.image = image
            }

        },
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
@import '../../../../sass/variables';
.new_post_container{
    background: $bg_medium;
    border-radius: 5px;

    input{
        border-radius: 40px;
        background: $border;
        border: none;
        padding: 5px 15px;
        color: $color;
        outline: none;
        width: 100%;
    }
}

hr{
    background: $border;
}
button{
    border-radius: 40px;
    width: auto;
    padding: 5px 15px;
}
.btn{
    padding: 2px 15px;
}


// Extra small devices (portrait phones, less than 576px)
@media (max-width: 575.98px) {
    .add-photo{

    }
}

// Small devices (landscape phones, less than 768px)
@media (max-width: 767.98px) {
    .add-photo{
        height: 15px;
    }
}

// Medium devices (tablets, less than 992px)
@media (max-width: 991.98px) {
    .add-photo{

    }
}

// Large devices (desktops, less than 1200px)
@media (max-width: 1199.98px) {
    .add-photo{
        height: 18px;
    }
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
