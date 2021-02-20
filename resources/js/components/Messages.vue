<!--suppress ALL -->
<template>
        <div class="message-container">
            <transition name="notification">
                <div v-if="show_notification" class="call">
                    <div class="notifications">
                        <span>Incoming call from</span>
                        <span>{{ caller }}</span>
                    </div>
                    <div class="actions">
                        <div class="accept">
                            <div @click="acceptCall">
                                Accept
                            </div>
                        </div>
                        <div class="reject">
                            <div @click="cancelCall">
                                Reject
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
            <div v-if="!empty" class="user-name">
                <p>{{ receiver_name }}</p>
                <div @click="startStream">
                    <img src="/images/videocall@2x.png" alt="">
                </div>
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
                    <div class="video_modal" id="video_modal">
                        <div class=" video-container">
                            <div class="caller_name">
                                <span>{{ receiver_name }}</span>
                            </div>
                            <div class="chat_controls">
                                <div id="mute" @click="mute" class="control">
                                    <img class="chat_box" src="/images/mute@2x.png" alt="">
                                </div>
                                <div id="chat_box" @click="chat" class="control">
                                    <img class="chat_box" src="/images/chatbox@2x.png" alt="">
                                </div>
                                <div id="cancel_call" @click="cancelCall" class="control" >
                                    <img class="cancel_call" src="/images/endcall@2x.png" alt="">
                                </div>
                                <div id="unmute" @click="unmute" class="control">
                                    <img class="cancel_call" src="/images/unmute@2x.png" alt="">
                                </div>
                            </div>
                          <video id="video" class="justify-content-center" autoplay muted></video>
                          <video id="partnerVideo" autoplay muted></video>
                        </div>
                    </div>

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
            <div v-if="!empty" class="txtMsg-container">
                <div class="input-group">
                    <input type="text" id="message_body" placeholder="New Message">
                    <div class="send" @click="send">
                        <img src="/images/send@2x.png" alt="">
                        <span>Send</span>
                    </div>
                </div>
            </div>
        </div>
</template>

<script>
import { bus } from '../app'
import Peer from 'simple-peer'

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
            logged_user: '',
            caller:'',
            show_notification: false,
            videoCallParams:{
                users: [],
                stream: null,
                channel: null,
                peer1: null,
                peer2: null,
                callerSignal: null,
                callAccepted:false
            }
        }
    },

    methods:{

      mute:function (){},

      closeVideoCall:function (){
          axios.post('/cancelCall/'+this.conversation_id,{
              conversation_id: this.conversation_id
          }).then((data)=>{
             this.stopStream()
          }).catch((error)=>{
              console.log(error)
          });
      },

      unmute:function (){

      },

      chat:function (){},

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

      startStream: function (){
          const video = document.getElementById('video');
          $("#video_modal").toggle()
          $("#video").toggle()

          navigator.mediaDevices.getUserMedia({
              audio: true,
              video: true
          }).then(stream => {
              handleSuccess(stream)
          });

          const handleSuccess =  (stream) => {
              console.log(stream)
              video.srcObject = stream;
              video.play
              this.makeACall(stream)
          }
      },

      stopStream: function (videoElem){
              const stream = videoElem.srcObject;
              const tracks = stream.getTracks();

              tracks.forEach(function(track) {
                  track.stop();
              });

              videoElem.srcObject = null;
      },

      async makeACall(stream){
          // Initialize the state stream
          this.videoCallParams.stream = stream

          // Instantiate the initiator peer
          this.videoCallParams.peer1 = new Peer({
              initiator: true,
              trickle: false,
              stream: this.videoCallParams.stream,
          });

          // Join the presence channel
          this.videoCallParams.channel = window.Echo.join("presence-video-channel");

          //Make the call
          this.videoCallParams.peer1.on("signal", (data) => {
              axios
                  .post('/makecall/'+this.conversation_id,{
                      conversation_id: this.conversation_id,
                      signal_data: data,
              })
                  .then((data)=>{
              })
                  .catch((error)=>{
                  console.log(error)
              });
          });

          this.videoCallParams.peer1.on("stream", (stream) => {
              console.log(stream)
              console.log("Received Stream")
              const video = document.getElementById('partnerVideo');
              $("#partnerVideo").toggle()
              video.srcObject = stream;
              video.play
          });

          this.videoCallParams.peer1.on("connect", () => {
              console.log("Peer connected");
          });

          this.videoCallParams.peer1.on("error", (err) => {
              console.log(err);
          });

          this.videoCallParams.peer1.on("close", () => {
              const video = document.getElementById('video');
              const partner = document.getElementById('partnerVideo');
              const stream = video.srcObject;
              const videoTracks = stream.getTracks();
              const partnerTracks = stream.getTracks();

              videoTracks.forEach(function(track) {
                  track.stop();
              });
              partnerTracks.forEach(function(track) {
                  track.stop();
              });

              video.srcObject = null;
              partner.srcObject = null;

              $("#partnerVideo").toggle()
              $("#video_modal").toggle()
              $("#video").toggle()
          });

          this.videoCallParams.channel.listen("AcceptCall", ({ data }) => {
              console.log(data)
              if (data.signal.renegotiate) {
                  console.log("renegotating");
              }
              if (data.signal.sdp) {
                  this.videoCallParams.callAccepted = true;
                  const updatedSignal = {
                      ...data.signal,
                      sdp: `${data.signal.sdp}\n`,
                  };
                  this.videoCallParams.peer1.signal(updatedSignal);
              }
          });


      },

      cancelCall: function (){
          axios.post('/cancelCall/'+this.conversation_id,{
              conversation_id: this.conversation_id
          }).then((data)=>{
              if (this.show_notification === true){
                  this.show_notification = false
              }
          }).catch((error)=>{
              console.log(error)
          });
      },

      acceptCall: function(){
          // Start displaying the receiver video
          const video = document.getElementById('video');
          $("#video_modal").toggle()
          $("#video").toggle()

          const handleSuccess =  (stream) => {
              video.srcObject = stream;
              this.videoCallParams.stream = stream;
              video.play
          }

          navigator.mediaDevices.getUserMedia({
              audio: true,
              video: true
          }).then(stream => {
              handleSuccess(stream)
              this.startPeers(stream)
          });


      },
      async startPeers (stream){
          this.videoCallParams.stream = stream
          // Start the receiver peer
          this.videoCallParams.peer2 = new Peer({
              initiator: false,
              trickle: false,
              stream: this.videoCallParams.stream
          });

          this.videoCallParams.channel = window.Echo.join("presence-video-channel");

          this.show_notification = false;

          //Send signal to the user that the call has been accepted
          this.videoCallParams.peer2.on("signal", (data) => {
              axios
                  .post('/acceptCall/'+this.conversation_id,{
                      conversation_id: this.conversation_id,
                      signal: data
                  })
                  .then(()=>{
                      console.log("Call accepted")
                  })
                  .catch((error)=>{
                      console.log(error)
                  });
          });

          this.videoCallParams.peer2.on("stream", (stream) => {
              console.log(stream)
              const video = document.getElementById('partnerVideo');
              $("#partnerVideo").toggle()
              video.srcObject = stream;
              video.play

          });

          this.videoCallParams.peer2.on("connect", () => {
              console.log("peer connected");
          });

          this.videoCallParams.peer2.on("error", (err) => {
              console.log(err);
          });

          this.videoCallParams.peer2.on("close", () => {
              const video = document.getElementById('video');
              const partner = document.getElementById('partnerVideo');
              const stream = video.srcObject;
              const videoTracks = stream.getTracks();
              const partnerTracks = stream.getTracks();

              videoTracks.forEach(function(track) {
                  track.stop();
              });
              partnerTracks.forEach(function(track) {
                  track.stop();
              });

              video.srcObject = null;
              partner.srcObject = null;

              $("#partnerVideo").toggle()
              $("#video_modal").toggle()
              $("#video").toggle()
          });

          this.videoCallParams.peer2.signal(this.videoCallParams.callerSignal);
      },

      notification: function (caller){
          this.caller = caller
          this.show_notification = true
      },

      initiatePeers: function (stream){
          var initiatorPeer = new Peer({
              initiator: true, stream: stream
          });
          initiatorPeer.on('signal', data => {

          })
      },

      calleeStream: function (){
              const video = document.getElementById('video');
              $("#video_modal").toggle()
              $("#video").toggle()

              const handleSuccess =  (stream) => {
                  video.srcObject = stream;
                  this.videoCallParams.stream = stream;
                  video.play
              }

              navigator.mediaDevices.getUserMedia({
                  audio: true,
                  video: true
              }).then(stream => {
                  handleSuccess(stream)
              });
      },

      listen(){
          //Listen for incoming messages
          Echo.channel('messages.'+this.conversation_id)
            .listen('NewMessage',(message) => {
                let new_message = {
                    message_body: message.message,
                    receiver_id: message.receiver_id
                }
                this.messages.push(new_message)
            });

          // Listen for incoming calls
          Echo.channel('call.'+this.conversation_id)
              .listen('CallEvent',(data)=>{
                  this.notification(data.caller)

                  const updatedSignal = {
                      ...data.data.signalData,
                      sdp: `${data.data.signalData.sdp}\n`,
                  };

                  this.videoCallParams.callerSignal = updatedSignal;
                  console.log(data.data)
              });

          // Listen for cancel request
          Echo.channel('call.'+this.conversation_id)
              .listen('CancelCall',(data)=>{
                  const video = document.getElementById('video');
                  this.stopStream(video)
                  $("#video_modal").toggle()
                  $("#video").toggle()
              });

          // Listen for accept request
          Echo.channel('call.'+this.conversation_id)
              .listen('AcceptCall',(data)=>{

              });


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
            background: $bg_dark;
            display: flex;
            justify-content: center;
            .input-group{
                width: 90%;
                align-items: center;
                justify-content: space-between;
                input[type="text"]{
                    flex-grow: 1;
                    align-items: center;
                    color: $color;
                    border-radius: 20px;
                    background: $bg_light;
                    border: 1px solid $border;
                    padding: 5px 10px;
                    outline: none;
                    margin-right:10px;
                }
                .send{
                    border-radius: 10px;
                    border: 2px solid $border;
                    padding: 5px 15px;
                    width: 50px;
                    background: $bg_black;
                    height: 40px;
                    transition: border 400ms;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    transition: all 400ms;
                    span{
                        display: none;
                    }
                    &:hover{
                        background: $sent;
                        color: $white;
                        transition: all 400ms;
                    }
                    img{
                        height: 20px;
                        width: auto;
                    }
                }
            }
        }
        .messages{
            flex-grow: 1;
            padding: 2px ;
            background: url("/images/default_bg.png");
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover; /* Resize the background image to cover the entire container */
            overflow: auto;
            color: $color;
            #messages{
                padding: 2px 20px;
            }
            .empty-container{
                display: flex;
                justify-content: center;
                background: $bg_dark;
                background-position: center; /* Center the image */
                background-repeat: no-repeat; /* Do not repeat the image */
                padding: 0;
                background-size: cover; /* Resize the background image to cover the entire container */
                width: 100%;
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
                background: $received;
                padding: 0 10px;
                border-radius: 10px 10px 10px 0;
                float: left;
                clear: both;
                margin: 5px 0;
                min-height: 20px;
            }
            .sent{
                max-width: 30%;
                overflow-x: hidden;
                background: $sent;
                padding: 0 10px;
                border-radius: 10px 10px 0 10px;
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
            background: $bg_dark;
            padding: 0 10px;
            border-bottom: 1px solid $border;
            color: $user-name;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            img{
                height: 20px;
                width: auto;
            }
        }
        .call{
            position: absolute;
            background: grey;
            right: 10px;
            top: 20px;
            width: 250px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            overflow: hidden;
            .actions{
                width: 30%;
                border-left: 1px solid;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                .accept{
                    text-align: center;
                    //border-bottom: 1px solid $bg_light;
                    width: 100%;
                    background: $online;
                    color: $color;
                    cursor: pointer;
                }
                .reject{
                    text-align: center;
                    width: 100%;
                    height: 50%;
                    background: $red;
                    color: $color;
                    cursor: pointer;
                }
            }
            .notifications{
                width: 70%;
                height: 50%;
                padding: 5px;
                color: $color;
                text-align: center;
                display: flex;
                flex-direction: column;
            }
        }
        .notification-enter-active{
            animation: wobble .5s ease;
        }
        .notification-leave-active{
            transition: all .4s ease;
        }
        @keyframes wobble{
            0%{opacity: 0;transform: translateY(-60px);}
            50%{opacity: 1;transform: translateY(0px); }
            60%{transform: translateX(8px);}
            70%{transform: translateX(-8px);}
            80%{transform: translateX(4px)}
            90%{ transform: translateX(-4px);}
            100%{transform: translateX(0);}
        }
    }


    #partnerVideo{
        height: 100vh;
        display: none;
        margin: 0 auto;
    }
    #video{
        width: 25%;
        height: auto;
        display: none;
        position: absolute;
        border-radius: 5px;
        left: 5px;
        bottom: 5px;
    }
    /* The Modal (background) */
    .video_modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        overflow: hidden;
        max-height: 100vh; /* Full height */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,1); /* Black w/ opacity */
    }
    .caller_name{
        position: absolute;
        top: 20px;
        text-align: center;
        font-size: 20px;
        background: $bg_light;
        padding: 5px 10px;
        border-radius: 10px;
    }
    .chat_controls{
        position: absolute;
        bottom: 20px;
        display: flex;
        align-items: center;
        height: auto;
        width: auto;
        transition: all .3s;

        &:hover{
            bottom: 30px;
            transition: all .3s;
        }
        .cancel_call{
            height: 100%;
            width: auto;
            margin:  auto;
        }
        .chat_box{
            height: 100%;
            width: auto;
            margin: auto;
        }
    }

    /* Modal Content/Box */
    .video-container{
        margin: 0 auto; /* 15% from the top and centered */
        width: 100%;
        justify-content: center;
        display: flex;
        height: 100vh;
    }
    .control{
        height: 80px;
        overflow: hidden;
        margin: 5px;
        padding: 5px;
    }


    p{
            margin: 0;
        }
/* width */
/* width */
::-webkit-scrollbar {
    width:8px;
    border-radius: 10px;
}
::-webkit-scrollbar:hover {
    width:10px;
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

