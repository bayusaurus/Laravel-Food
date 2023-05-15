window._ = require('lodash');

// // import 'bootstrap';
// // import 'select2'

// window.axios = require('axios');

// window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
// require('./components/ExampleComponent.vue');
// // require('./components/Lyrics/Create');

import Vue from 'vue';
window.Vue = require('vue');

Vue.component('coba', require('./components/Coba.vue').default);
// Vue.component('delete', require('./components/Delete.vue').default);

const app = new Vue({
    el: '#vue'
});
window.Swal = require('sweetalert2');
