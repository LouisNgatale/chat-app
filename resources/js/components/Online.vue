<template>
    <div>
        <div class="heading">
            <span>Online now</span>
            <div>
                <span>15</span>
            </div>
        </div>
        <div class="images">
            <div v-if="empty">
                <span>No one is online</span>
            </div>
            <div v-else>
              <div class="online-accounts">
                  <div class="online-account">
                      <img class="" src="https://randomuser.me/api/portraits/women/67.jpg" alt="">
                  </div>
                  <div class="online-account">
                      <img class="" src="https://randomuser.me/api/portraits/women/68.jpg" alt="">
                  </div>
                  <div class="online-account">
                      <img class="" src="https://randomuser.me/api/portraits/women/12.jpg" alt="">
                  </div>
                  <div class="online-account">
                      <img class="" src="https://randomuser.me/api/portraits/women/22.jpg" alt="">
                  </div>
                  <div class="online-account">
                      <img class="" src="https://randomuser.me/api/portraits/women/50.jpg" alt="">
                  </div>
                  <div class="online-account">
                      <img class="" src="https://randomuser.me/api/portraits/women/57.jpg" alt="">
                  </div>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
name: "Online",
    data(){
    return{
        empty:false
    }
    }
}
</script>

<style lang="scss" scoped>
@import '../../sass/variables';

    .heading{
        color: $color;
        display: flex;
        justify-content: space-between;
        padding-right: 10px;
        padding-left: 10px;
        div{
            background: $white;
            border-radius: 5px;
            height: 20px;
            width: 20px;
            span{
                color: $bg_black;
                text-align: center;
            }
        }
    }
    .images{
        padding-left: 10px;
        height: 100px;
        text-align: center;
        display: flex;
        justify-content: flex-start;
        flex-direction: row;
        align-items: center;
        color: $color;
        overflow-x: auto;
        .online-accounts{
            display: flex;
            justify-content: flex-start;
            flex-direction: row;
            img{
                height: 60px;
                width: 60px;
                justify-content: flex-start;
                -webkit-border-radius: 100%;
                -moz-border-radius: 100%;
                border-radius: 100%;
                border: 3px solid $online;
                margin: 0 5px;
            }
        }
    }
/* width */
/* width */
::-webkit-scrollbar {
    height:4px;
    border-radius: 10px;
}

/* Track */
::-webkit-scrollbar-track {
    background: $bg_light;
}

/* Handle */
::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 20px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555;
}

</style>
