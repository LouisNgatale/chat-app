<template>
    <div class="friends text-white p-3 container">
        <div style="height: 40px" class="row justify-content-center align-items-center">
            <div class="col">
                <input type="text" class="w-100" placeholder="Search">
            </div>
        </div>
        <div class="row">
            <div class="col">
                Friends list
            </div>
        </div>
    </div>

</template>

<script>
export default {
name: "Friends"
}
</script>

<style lang="scss" scoped>
@import '../../../../sass/variables';
.friends{
    background: $bg_medium;
    border-radius: 5px;
    height: 150px;
}

input{
    background: $bg_black;
    padding: 5px 15px;
    outline: none;
    color: $color;
    border-radius: 5px;
    border: none;
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
