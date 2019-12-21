import Vue from 'vue';
import App from './App.vue'
import VueRouter from 'vue-router';
import Config from './components/Config'
Vue.use(VueRouter);
const routes = [

    {
        path: '/config',
        component: Config,
        name: 'Config'
    },


];

const router = new VueRouter({
    routes,
    mode: 'hash'
});

const app = new Vue({
    el: '#app',
    render: h => h(App),
    router
});
// global.app = app;