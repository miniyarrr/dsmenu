


import Vue from 'vue';
import App from './App.vue'
import VueRouter from 'vue-router';

Vue.use(VueRouter);
const routes = [


];

const router = new VueRouter({
    routes,
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    router,
    render: h => h(App)
});
global.app = app;