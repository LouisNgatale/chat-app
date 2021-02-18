<template>
    <div>
        <div class="heading">
            <div @click="viewMenu" class="column">
                <img src="/images/Icon%20feather-settings@2x.png" alt="">
            </div>
            <div id="menu">
                <div class="menu-item">
                    <span>Profile</span>
                </div>
                <div class="menu-item">
                    <span>Settings</span>
                </div>
                <div @click="logout" class="menu-item">
                    <span>Log Out</span>
                </div>
            </div>
        </div>
        <div>
            <div class=" details">
                <img alt="" class="mb-3"  src="data:image/jpeg;base64,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">
                <h4 class="username">{{ user }}</h4>
                <span class="status">Current Status</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "Header",
props:['user'],
    data(){
    return{
      menu: false
    }
    },
methods:{
    viewMenu:()=>{
        $("#menu").toggle();
    },
    logout:()=>{
            axios.post('/logout').then((e)=>{
                window.location.href = '/login';
            }).catch((e)=>{
                console.log(e)
            })
        }
}
}
</script>

<style  scoped lang="scss">
@import '../../sass/variables';
    .heading{
        display: flex;
        width: 100%;
        justify-content: flex-end;
        padding: 10px;
        img{
            max-height: 25px;
            width: auto;
            display: block;
        }
        #menu{
            position: absolute;
            background: $sent;
            top: 40px;
            color: $color;
            width: 150px;
            padding: 5px 0;
            border-radius: 5px;
            display: none;
            .menu-item{
                padding: 5px;
                &:hover{
                    background: $bg_dark;
                    cursor: pointer;
                }
            }
        }
    }
    .details{
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        img{
            height: 100px;
            width: 100px;
            border-radius: 100%;
        }
        .username{
            color: $color;
        }
        .status{
            color: $sub_heading;
        }
    }

</style>
