<template>
    <div class="w-100 subcomment py-2">
        <div class="comment_container">
            <div id="comment_auth_img " class="mr-2">
                <img src="/images/blank.png" class="rounded-circle dp img-fluid" alt="">
            </div>
            <div id="comment_body_container">
                <div class="author font-italic">Author Name</div>
                <div id="comment_body">
                    <div>{{ child.body }}</div>
                    <div>
                        <div class="text-left comment-actions">
                            <span class="mr-2">1h ago</span>
                            <span class="mr-2"><img src="/images/skips.png" alt=""></span>
                            <span class="mr-2">2 replies</span>
                            <span class="mr-2"><img src="/images/skips.png" alt=""></span>
                            <span class="mr-2">1h Reply</span>
                        </div>
                    </div>
                    <div id="sub_comment_container">
                        <div class="">
<!--                            <subComment v-for="child in child.childComments" :key="child" v-bind:child="child"></subComment>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--<div class="row justify-content-center">
            <div class="col-1 left_border pr-0">
                <div class="pr-2">
                    <img src="/images/blank.png" class="rounded-circle float-right w-100 img-fluid" alt="">
                </div>
            </div>

            <div class="col-10 pl-0">
                <span class="author font-italic">Name Here</span>
                <div>
                    {{ child.body }}
                </div>

                <div class="row">
                    <div class="col text-left comment-actions">
                        <span class="mr-2">1h ago</span>
                        <span class="mr-2"><img src="/images/skips.png" alt=""></span>
                        <span class="mr-2">2 replies</span>
                        <span class="mr-2"><img src="/images/skips.png" alt=""></span>
                        <span class="mr-2">1h Reply</span>
                    </div>
                </div>

            </div>
        </div>-->
    </div>
</template>

<script>
export default {
name: "SubComments",
    props:{
        child:{
            type:Object
        }
    },
}
</script>

<style lang="scss" scoped>
@import '../../../../../sass/variables';
.subcomment{
    color: $sub_heading;
}
.dp{
    height: 30px;
    width: auto;
}
.comment_container{
    display: flex;
    flex-direction: row;
    #comment_body_container{
        width: 90%;
        display: flex;
        flex-direction: column;
        #comment_body{
            display: flex;
            flex-direction: column;
            #sub_comment_container{

            }
        }
    }
}
.left_border{
    border-left: 2px solid $border;
}
// Extra small devices (portrait phones, less than 576px)
@media (max-width: 575.98px) {
    .comment-actions span{
        font-size: .6rem;
    }
}

// Small devices (landscape phones, less than 768px)
@media (max-width: 767.98px) {
    .comment-actions{
        font-size: .6rem;
    }
}

// Medium devices (tablets, less than 992px)
@media (max-width: 991.98px) {
    .comment-actions{
        font-size: .6rem;
    }
}

// Large devices (desktops, less than 1200px)
@media (max-width: 1199.98px) {
    .comment-actions{
        font-size: .7rem;
    }
}

</style>
