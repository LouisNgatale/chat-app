<template>
    <div class="social_profile container-fluid">

        <!--   Profile Picture   -->
        <div class="row justify-content-center ">
            <div class=" p-3 align-items-center">
                <img :src="'/storage/' + displayImage" class="rounded-circle w-50 img-fluid" alt="">
            </div>
        </div>

        <!--   Profile Name & username     -->
        <div class="row">
            <div class="col p-0">
                <p class="m-0">{{ name }}</p>
                <p class="username">@{{ userName }}</p>
            </div>
        </div>

        <!--   Profile Count  -->
        <div class="row post_counts justify-content-between  mb-2">
            <div class="col p-0">200 Posts</div>
            <div class="col p-0">200 Followers</div>
            <div class="col p-0">200 Following</div>
        </div>

        <!--   Profile Bio  -->
        <div class="row">
            <div class="col p-0">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col p-0">
                            <p class="mb-0">Bio</p>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col p-0 ">
                            <p>
                                {{ bio }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--   Profile Update Btn -->
        <div class="row">
            <button class="btn btn-primary">Update</button>
        </div>
    </div>
</template>

<script>

import { mapState } from 'vuex';
import {mapActions} from 'vuex';
import {mapGetters} from 'vuex';

export default {
name: "Profile",
    computed: {
        ...mapGetters([
            'name',
            'userName',
            'bio',
            'payload',
            'displayImage'
        ])
    },
    methods:{
        ...mapActions([
            'getUser'
        ]),
    },

    created() {
        this.getUser()
    }

}
</script>

<style lang="scss" scoped>
@import '../../../../sass/variables';

.social_profile{
    color: $color;
}
.username{
    color: $sub_title;
}

hr{
    background: $color;
    margin-top: .3rem;
    margin-bottom: .3rem;
}
button{
    border-radius: 40px;
    width: 100px;

}


// Extra small devices (portrait phones, less than 576px)
@media (max-width: 575.98px) {
    .post_counts{
        font-size: .7rem;
    }
}

// Small devices (landscape phones, less than 768px)
@media (max-width: 767.98px) {
    .post_counts{
        font-size: .6rem;
    }
}

// Medium devices (tablets, less than 992px)
@media (max-width: 991.98px) {
    .post_counts{
        font-size: .6rem;
    }
}

// Large devices (desktops, less than 1200px)
@media (max-width: 1199.98px) {
    .post_counts{
        font-size: .7rem;
    }
}

</style>
