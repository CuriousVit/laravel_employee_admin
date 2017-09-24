/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

try {
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');

    window.axios = require('axios');
} catch (e) {}

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));
Vue.component('employees', require('./components/Employees.vue'));

const app = new Vue({
    el: '#app',

    data: {
        email: 'test@gmail.com',
        password: 'password'
    },

    methods: {

        onSubmit() {

            axios.post('/auth/login', this.$data, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(function (response) {
                console.log(response);
                if (response.data.auth) {
                    location.href = response.data.intended;
                }
            })
            .catch(function (error) {
                console.log(error);
            });

        }
    }

});

// console.log(app);