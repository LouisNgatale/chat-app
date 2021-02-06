<!--suppress ALL -->
<template>
        <div class="message-container">
            <div class="user-name">
                <p>{{ receiver_name }}</p>
            </div>

            <div  class="messages">
                <!-- Messages are not found -->
                <div v-if="empty" class="empty-container">
                    <div class="content">
                        {{ content }}
                    </div>
                </div>

                <!--  Load the messages from the database  -->
                <div v-else id="messages">

                    <div v-for="message in messages" :key="message.id">

                        <div v-if="message.receiver_id == logged_user ">
                            <div class="received">
                                <p> {{ message.message_body }} </p>
                            </div>
                        </div>

                        <div  v-else>
                            <div class="sent">
                                <p>{{ message.message_body }}</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="txtMsg-container">
                <div class="input-group">
                    <input type="text" id="message_body" placeholder="New Message">
                    <input type="submit" value="Send" @click="send">
                </div>
            </div>
        </div>
</template>

<script>
import { bus } from '../app'

export default {
    data(){
        return{
            id:"",
            empty:true,
            content:"Choose a contact to start messaging",
            sender_id:"",
            receiver_id:"",
            receiver_name:"",
            conversation_id: "",
            messages: [],
            logged_user: ''
        }
    },
    methods:{
      send: function(){
          let message_body = $("#message_body").val();
          if (message_body !== ""){
              this.sendMessage(message_body);
            $("#message_body").val("");
          }else {

          }
      },
      sendMessage: function(message_body) {
            axios.post('/sendMessage',{
                message_body:message_body,
                conversation_id:this.conversation_id,
                receiver_id: this.receiver_id
            }).then((response) => {
                let sent_message = {
                    message_body: response.data,
                }
                this.messages.push(sent_message);
            }).catch((error) => {
                console.log(error)
            })
        },
      retrieve_data: function (convoId)  {
            axios.get('/getConversation/'+ convoId)
                .then((data)=>{
                    //TODO: Refresh Messages
                    let messages = [];
                    data.data.forEach((x) => {
                        messages.push(x)
                    })
                    this.messages = messages
                })
                .catch((error)=>{
                    console.log(error)
                })
        },
      listen(){
          Echo.channel('messages.'+this.conversation_id)
            .listen('NewMessage',(message) => {
                let new_message = {
                    message_body: message.message,
                    receiver_id: message.receiver_id
                }
                this.messages.push(new_message)
            })
        }
    },
    created() {
        bus.$on('updateChatWindow',(data) => {
                this.receiver_name = data.name;
                this.receiver_id = data.receiver_id;
                this.conversation_id = data.conversation_id;
                this.logged_user = data.logged_user;
                this.empty = false;
                this.retrieve_data(data.conversation_id);
                this.listen();
        });
    },
}
</script>

<style scoped lang="scss">
@import '../../sass/variables';
    .message-container{
        display: flex;
        flex-direction: column;
        height: 100%;
        .txtMsg-container{
            height: 10%;
            background: $white;
            display: flex;
            justify-content: center;
            .input-group{
                width: 90%;
                align-items: center;
                justify-content: space-between;
                input[type="text"]{
                    flex-grow: 1;
                    align-items: center;
                    border-radius: 20px;
                    background: $white_blue;
                    border: 0;
                    padding: 5px 10px;
                    outline: none;
                    margin-right:10px;
                }
                input[type="submit"]{
                    color: $dark_blue;
                    border-radius: 10px;
                    border: 2px solid $dark_blue;
                    outline: none;
                    padding: 5px 10px;
                    width: 100px;
                    transition: border 400ms;
                    &:hover{
                        background: $dark_blue;
                        color: $white;
                        transition: all 400ms;
                    }
                }
            }
        }
        .messages{
            flex-grow: 1;
            padding: 2px 20px;
            background: $white_blue;
            overflow: auto;
            .empty-container{
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
                .content{
                    text-align: center;
                    font-size: 28px;
                    color: $light_blue;
                }
            }
            .received{
                max-width: 30%;
                overflow-x: hidden;
                background: white;
                padding: 0 10px;
                border-radius: 10px;
                float: left;
                clear: both;
                margin: 5px 0;
                min-height: 20px;
            }
            .sent{
                max-width: 30%;
                overflow-x: hidden;
                background: $dark_blue;
                padding: 0 10px;
                border-radius: 10px;
                float: right;
                clear: both;
                margin: 5px 0;
                color: #E9E9EB;
                min-height: 20px;
            }
        }
        .user-name{
            width: 100%;
            min-height: 50px;
            background: $white_blue;
            padding: 0 10px;
            border-bottom: 1px solid $grey;
            color: $user-name;
            font-size: 18px;
            display: flex;
            align-items: center;
        }
    }
    p{
        margin: 0;
    }
</style>
