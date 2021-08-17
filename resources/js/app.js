require('./bootstrap');

import Vue from 'vue';
import router from './route';
import VueNoty from 'vuejs-noty'
import moment from 'moment'

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('menu-component', require('./components/panel/Menu.vue').default);
Vue.component('sidebar-component', require('./components/panel/Sidebar.vue').default);
Vue.component('logout-component', require('./components/panel/Logout.vue').default);
Vue.use(VueNoty)



const app = new Vue({
    el: '#app',
    data : {
        title: "Testing",
    },
    router
});
