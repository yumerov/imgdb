require("./bootstrap");

window.Vue = require('vue');
window.VueRouter = require("vue-router");
window.Vue.use(VueRouter);

require('./components');
import routes from './routes';
import VueRouter from "vue-router";

const router = new VueRouter({ routes });
const app = new Vue({
    el: '#app',
    router,
});
// require('./bulma-extensions');

// require('select2');
// window.$ = window.jQuery = require('jquery');

// $(document).ready(() => {
//     function readURL(input) {
//       if (input.files && input.files[0]) {
//         let reader = new FileReader();
//         reader.onload = function(e) {
//           $('#preview').attr('src', e.target.result);
//         }
//         reader.readAsDataURL(input.files[0]);
//       }
//     }

//     $('select').select2({
//         theme: "flat"
//     });

//     $('input[type="file"]').change((event) => {
//         let target = event.target;
//         let name = target.files[0].name;
//         $(target).siblings('.file-name').html(name);
//         readURL(target);
//     });
// });