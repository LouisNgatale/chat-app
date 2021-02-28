<template>
<div>
    <div  class="container py-2 pl-0">
        <div class="row justify-content-center">
            <div class="col-1 pr-0">
                <div class="pr-2">
                    <img src="/images/blank.png" class="rounded-circle float-right w-100 img-fluid" alt="">
                </div>
            </div>

            <div class="col-10 pl-0">
                <span class="author font-italic">Name Here</span>
                <div>
                    {{ comment.body }}
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
                <subComment v-for="child in comment.childComments" :key="child" v-bind:child="child"></subComment>
            </div>
        </div>
    </div>
</div>
</template>

<script>

import subComment from "./SubComment"
export default {
    name: "MainComment",
    components:{subComment},
    props:{
        comment:{
            type:Object
        }
    },

}
</script>

<style lang="scss" scoped>
@import '../../../../../sass/variables';
.author,
.comment-actions{
    color: $sub_heading;
}

// Extra small devices (portrait phones, less than 576px)
@media (max-width: 575.98px) {
    .comment-actions span{
        font-size: .7rem;
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
