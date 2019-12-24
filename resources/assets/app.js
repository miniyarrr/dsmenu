import Vue from 'vue';
import App from './App.vue'
import VueRouter from 'vue-router';
import Config from './components/Config'
import List from './components/List'
import Main from './components/Main'
Vue.use(VueRouter);
const routes = [

    {
        path: '/',
        component: Main,
        name: 'Main'
    },{
        path: '/configuration',
        component: Config,
        name: 'Config'
    },
    {
        path: '/list',
        component: List,
        name: 'List'
    },


];

const router = new VueRouter({
    routes,
    mode: 'history'
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
// global.app = app;