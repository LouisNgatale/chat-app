<template>
<div>
    <!--   Post   -->
    <div class="post mt-4 mb-4 container-fluid text-white">
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
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda corporis, dolore est harum illo iure, iusto molestias natus neque nihil obcaecati odio quibusdam reprehenderit, rerum sequi ut voluptatibus. Nam, perferendis?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda corporis, dolore est harum illo iure, iusto molestias natus neque nihil obcaecati odio quibusdam reprehenderit, rerum sequi ut voluptatibus. Nam, perferendis?
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda corporis, dolore est harum illo iure, iusto molestias natus neque nihil obcaecati odio quibusdam reprehenderit, rerum sequi ut voluptatibus. Nam, perferendis?
            </div>
        </div>

        <!--   Picture   -->
        <div class="row">
            <div class="col p-0">
                <img src="images/female_1.png" class="img-fluid" alt="">
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
        <div class="row"></div>

        <!--   Add Comment   -->
        <div class="row"></div>
    </div>
</div>
</template>

<script>
export default {
name: "Post"
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

hr{
    background: $border;
}
</style>
