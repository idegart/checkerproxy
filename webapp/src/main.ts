import Vue from 'vue'

import App from './App.vue'

import router from "./router";

import vuetify from './plugins/vuetify'

import Pusher from "pusher-js";
window.Pusher = Pusher

import Echo from "laravel-echo"
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'your-pusher-key',
    wsHost: 'core.checkerproxy.test',
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
    cluster: 'mt1'
});

new Vue({
    vuetify,
    router,
    render: (h) => h(App),
}).$mount('#app')
