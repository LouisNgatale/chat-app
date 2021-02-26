import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios'

Vue.use(Vuex);

export const store  = new Vuex.Store({
    state:{
        user:{
            firstName: "",
            secondName: "",
            userName: "",
            bio: "",
            image: "",
        },
    },

    getters:{
        name: (state) => {
            return  state.user.firstName + " " + state.user.secondName;
        },
        userName: (state) => {
            return state.user.userName;
        },
        bio:(state) => {
            return state.user.bio;
        },
        payload:(state) =>{
            return state.user.payload
        },
        image:(state) =>{
            return state.user.image
        }
    },

    mutations:{
    },

    actions:{
        getUser: function (context)  {
            axios.get('/user')
                .then(response => {
                    this.state.user.firstName = response.data.data.firstName;
                    this.state.user.secondName = response.data.data.secondName;
                    this.state.user.userName = response.data.data.userName;
                    this.state.user.bio = response.data.data.bio;
                    this.state.user.image = response.data.data.image;
                })
        }
    }
});
