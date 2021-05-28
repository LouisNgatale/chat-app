<template>
    <div>
        <div class="window">
            <div class="card-items">
                <div class="user-list">
                    <Header :user="user" :status="status" :image="image"></Header>
                    <Online></Online>
                    <UserList></UserList>
                </div>
                <div  class="messages">
                    <Messages></Messages>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import UserList from "./UserList";
    import Messages from "./Messages";
    import Header from "./Header";
    import Online from "./Online";
    export default {
        components: {Online, Header, Messages, UserList},
        props:['user','status','image'],
        methods:{
        },
        created(){
            console.log("Test");
            console.log("Test");
        }
    }
</script>
<style scoped lang="scss">
@import '../../sass/variables';
    .card-items{
        display: flex;
        flex-direction: row;
        height: 100%;
        .user-list{
            width: 30%;
            padding:0;
            background: $bg_black;
        }
        .messages{
            width: 70%;
        }
    }
    .window{
        height: 100vh;
    }
</style>
