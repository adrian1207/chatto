window._ = require('lodash');
window.vueIsotope = require('vueisotope');
window.imagesLoaded = require('vue-images-loaded');

/**
 * jQuery, Bootstrap 3, jQueryUI
 */
window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');
require('jquery-ui/ui/widgets/dialog');

/**
 * @type {Vue$2}
 */
window.Vue = require('vue');

require('vue-resource');

/**
 * CSRF
 */
Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});

/**
 * Vue Production Mode
 */
Vue.config.devtools = false;
Vue.config.debug = false;
Vue.config.silent = true;


/**
 * Echo
 */
import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'https://localhost:3000',
    namespace: 'chatto.Events'
});