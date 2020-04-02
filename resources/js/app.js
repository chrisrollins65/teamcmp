import Vue from 'vue';
import VueRouter from 'vue-router';
import Profile from './views/Profile';
import Chat from './views/Chat';

Vue.use(VueRouter);

Vue.component('app', require('./components/App.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Profile
        },
        {
            path: '/chat',
            component: Chat,
        },
    ],
});

const app = new Vue({
    el: '#app',
    router,
});
