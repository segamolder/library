/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */
import addauthor from "./components/addauthor.vue";
import addbook from "./components/addbook.vue";
import addcategory from "./components/addcategory.vue";
import books from "./components/books.vue";

require('./bootstrap');
window.Vue = require('vue');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('booklist', require('./components/booklist.vue').default);
Vue.component('addauthor', addauthor);
Vue.component('addbook', addbook);
Vue.component('addcategory', addcategory);
Vue.component('books', books);

import VueTheMask from 'vue-the-mask'
Vue.use(VueTheMask)

const app = new Vue({
    el: '#app',

});
