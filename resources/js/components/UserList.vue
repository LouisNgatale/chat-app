<template>
    <div>
        <div class="header">
            <span>Chats</span>
            <div class="search_box">
                <input  v-model="search" type="text" placeholder="Search">

                <div class="search_results" v-if="searchedUsers">
                    <div v-for="user in searchedUsers">
                        <span>{{ user.name }}</span>
                    </div>
                </div>
            </div>

        </div>
        <div class="user-wrapper" v-for="user in users" :name="user.Participant_A" :id="user.Conversation_Id" :receiver_id="user.Participant_A_id" v-on:click="clicked">
            <div class="user" id="user" >
                <div class="user-img">
                    <img class="" src="/images/blank.png" alt="">
                </div>
                <div class="user-placeholder">
                    <div class="user-name">
                        <p>{{ user.Participant_A }}</p>
                    </div>
                    <div class="recent-message">
                        <p>Recent Message...</p>
                    </div>
                </div>
            </div>
                <hr>
        </div>
    </div>
</template>

<script>
import { bus } from '../app'

export default {
    name: "UserList",

    data(){
        return{
            userId:"test",
            users:[],
            conversation_payload:[],
            logged_user: "",
            search:'',
            searchedUsers:[]
        }
    },

    methods:{
        clicked: function ()  {
            let target = event.target;
            let source = $(target).parentsUntil(".user-wrapper").parent();
            let id = $(source[0]).attr("id");
            let name = $(source[0]).attr("name");
            let receiver_id = $(source[0]).attr("receiver_id");
            let logged_user = this.logged_user;
            let payload = {
                logged_user: logged_user,
                conversation_id : id,
                name : name,
                receiver_id: receiver_id
            }
            bus.$emit('updateChatWindow',payload);
        },

        results:function (){
            if (this.search){
                 axios.get('/search/'+this.search)
                    .then((response)=>{
                          this.searchedUsers =  response.data
                    }).catch((error)=>{
                        console.log(error);
                    });
            }else {
                this.searchedUsers = ""
            }
        }
    },

    watch: {
        search(after, before) {
            this.results()
        }
    },

    created() {
        axios.get('/conversation').then((response)=>{
            this.users = response.data.Users;
            this.logged_user = response.data.Logged_User;
        }).catch((error)=>{
            console.log(error);
        })
    }
}
</script>

<style scoped lang="scss">
@import '../../sass/variables';
    p{
        margin: 0;
    }
    .header{
        background: $bg_black;
        color: $color;
        padding: 10px;
        display: flex;
        flex-direction: column;
        span{
            padding-bottom: 10px;
        }
        .search_box{
            width: 100%;
        }
        input{
            border: none;
            background: $bg_dark;
            border-radius: 5px;
            padding: 5px;
            outline: none;
            color: $sub_heading;
        }
        .search_results{
            background: $bg_dark;
            padding: 10px;
            margin-top: 5px;
            z-index: 1;
        }
    }
    .user{
        display: flex;
        height: 60px;
        width: 100%;
        color: $color;
        &:hover{
            background: $bg_light;
            cursor: pointer;
        }
        .user-img{
            width: 70px;
            margin: auto 5px;
            padding: 5px;
            img{
                height: 40px;
                width: 40px;
                border-radius: 100%;
            }
        }
        .user-placeholder{
            display: flex;
            flex-direction: column;
            margin: 0;
            justify-content: center;
            width: 100%;
        }
    }
    hr{
        margin: 0;
    }
</style>
