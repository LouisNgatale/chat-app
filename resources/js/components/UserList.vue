<template>
    <div>
        <div class="header">
            <h4>Inbox</h4>
        </div>
        <div class="user-wrapper" v-for="user in users" :name="user.Participant_A" :id="user.Conversation_Id" :receiver_id="user.Participant_A_id" v-on:click="clicked">
            <div class="user" id="user" >
                <div class="user-img">
                    <img class="rounded-circle img-thumbnail w-100 mx-auto d-block" src="/images/blank.png" alt="">
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
            logged_user: ""
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
        background: $light_blue;
        color: white;
        padding: 10px;
        height: 50px;
    }
    .user{
        display: flex;
        height: 60px;
        width: 100%;
        color: #E9E9EB;
        &:hover{
            background: $hover_blue;
            cursor: pointer;
        }
        .user-img{
            width: 70px;
            margin: auto 5px;
            padding: 5px;
            img{

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
