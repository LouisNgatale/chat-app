<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card window">
                    <div class="card-items">
                        <div class="user-list">
                            <Header :user="user"></Header>
                            <Online></Online>
                            <UserList></UserList>
                        </div>
                        <div  class="messages">
                            <Messages></Messages>
                        </div>
                    </div>
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
        props:['user'],
        methods:{
        },
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
