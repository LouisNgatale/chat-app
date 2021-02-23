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
            <div class="details">
                <img alt="" class="mb-3"  v-bind:src="'/storage/' + image ">
                <h4 class="details_username">{{ user }}</h4>
                <span class="details_status">{{  status  }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Header",
    props:['user','status','image'],
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
        .details_username{
            color: $color;
        }
        .details_status{
            color: $sub_heading;
        }
    }

</style>
