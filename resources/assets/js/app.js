require("./bootstrap");

window.Vue = require('vue');
window.VueRouter = require("vue-router");
window.Vue.use(VueRouter);

require('./components');
require('./events');
import routes from './routes';
import VueRouter from "vue-router";

const router = new VueRouter({ routes });
const app = new Vue({
    el: '#app',
    router,
});
