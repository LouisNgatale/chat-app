<template>
<div class="text-white new_post_container container-fluid p-2">
    <!--   Top Row   -->
    <div class="row p-4 align-items-center justify-content-center">
        <!--   Profile Picture   -->
        <div class="col-md-2 pr-0">
            <img src="images/blank.png" class=" rounded-circle w-50 img-fluid" alt="">
        </div>
        <!--   Input new Post   -->
        <div class="col-md-10 pl-0">
            <input type="text" class="float-left w-100 text-white" placeholder="What's on your mind?">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <hr>
        </div>
    </div>
    <!--   Bottom row   -->
    <div class="row align-items-center">
        <div class="col-3">
            <div >
                <img src="/images/addImage.png" class="float-right img-fluid" alt="">
                <span class="float-right mr-2">Add Photo</span>
            </div>
        </div>
        <div class="col">
            <button class="btn btn-primary ">Add post</button>
        </div>
    </div>

</div>
</template>

<script>
export default {
name: "Createpost"
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
