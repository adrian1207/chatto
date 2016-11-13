
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

Echo.join('presence_channel')
    .here((users) => {
        console.log("Wszedłem");
        console.log(users);
    })
    .joining((user) => {
        console.log("Ktoś wszedł");
        console.log(user);
    })
    .leaving((user) => {
        console.log("Ktoś wyszedł");
        console.log(user);
    });