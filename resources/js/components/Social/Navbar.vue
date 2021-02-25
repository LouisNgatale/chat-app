<template>
<div class="text-white w-100 nav-container container-fluid">
    <div style="height: 100%" class="row justify-content-center align-items-center">
        <div class="col-4">
            <input type="text" class="w-100" placeholder="Search">
        </div>
    </div>
</div>
</template>

<script>
export default {
name: "Navbar"
}
</script>

<style lang="scss" scoped>
@import '../../../sass/variables';

.nav-container{
    background: rgb(76,76,77);
    background: linear-gradient(225deg, rgba(76,76,77,1) 0%, rgba(59,59,59,1) 100%, rgba(112,112,112,1) 100%);
    height: 50px;
}

input{
    background: $bg_black;
    padding: 5px 15px;
    outline: none;
    color: $color;
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
