/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';

Vue.use(VueRouter);

import swal from 'sweetalert2';
import {
    Form,
    HasError,
    AlertError
} from 'vform';
window.Form = Form;
window.swal = swal;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
let routes = [{
        path: '/students',
        component: require('./components/Student.vue')
    },
    {
        path: '/teachers',
        component: require('./components/Teachers.vue')
    },
    {
        path: '/dashboard',
        component: require('./components/Dashboard.vue')
    },
    {
        path: '/courses',
        component: require('./components/Courses.vue')
    },
    {
        path: '/departments',
        component: require('./components/Department.vue')
    },
    {
        path: '/users',
        component: require('./components/Users.vue')
    }

];

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const router = new VueRouter({
    mode: 'history',
    routes, // short for `routes: routes`
    linkActiveClass: 'active'
});
const app = new Vue({
    el: '#app',
    routes,
    router
});
