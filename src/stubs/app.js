require('./bootstrap');

window.Vue = require('vue');

Vue.component('ExampleComponent', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});
