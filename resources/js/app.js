/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

//Slots
Vue.component('slot_button', require('./components/slots/Button').default);

Vue.component('chat-window', require('./components/ChatWindow.vue').default);
Vue.component('welcome', require('./components/AuthPages/Welcome-description').default);
Vue.component('register', require('./components/AuthPages/Register').default);

//Social Components
Vue.component('Createpost', require('./components/Social/middle_panel/Createpost').default);
Vue.component('Profile', require('./components/Social/left_panel/Profile').default);
Vue.component('Navbar', require('./components/Social/Navbar').default);
Vue.component('Posts', require('./components/Social/middle_panel/posts/Post').default);
Vue.component('Trending', require('./components/Social/right_panel/Trending').default);
Vue.component('Friends', require('./components/Social/right_panel/Friends').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

export const bus = new Vue();

const app = new Vue({
    el: '#app',
});
