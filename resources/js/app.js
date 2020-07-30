import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

require('./bootstrap');

window.Vue = require('vue');

import App from './views/App'
import Users from './views/Users'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/users',
            name: 'users',
            component: Users,
        }
    ],
});

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('events', require('./components/Events.vue').default);
Vue.component('venues', require('./components/Venues.vue').default);

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
