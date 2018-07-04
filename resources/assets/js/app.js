require("./bootstrap");

window.Vue = require('vue');
window.VueRouter = require("vue-router");
window.Vue.use(VueRouter);

import Vuex from "vuex";
window.Vue.use(Vuex);

require('./components');
require('./events');
import routes from './routes';
import VueRouter from "vue-router";

/**
 * @type {VueRouter}
 */
const router = new VueRouter({ routes });

const app = new Vue({
    el: '#app',
    router,
});
