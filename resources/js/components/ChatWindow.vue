<template>
    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card window">
                    <div class="card-items">
                        <div class="user-list">
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
    export default {
        components: {Messages, UserList},
        methods:{

        }
    }
</script>
<style scoped lang="scss">
@import '../../sass/variables';
    // Colors
    .card-items{
        display: flex;
        flex-direction: row;
        height: 100%;
        .user-list{
            width: 30%;
            padding:0;
            background: $light_blue;
        }
        .messages{
            width: 70%;
            border-left: 1px solid #657db0;
        }
    }
    .window{
        height: 100vh;
    }
</style>
