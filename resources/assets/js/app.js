// require('./bootstrap');

window.Vue = require('vue');
window.axios = require('axios');
Vue.component('app', require('./components/App.vue'));
Vue.component('app-header', require('./components/Header.vue'));
Vue.component('app-footer', require('./components/Footer.vue'));
Vue.component('nav-item', require('./components/NavItem.vue'));
Vue.component('home-main', require('./components/mains/Home.vue'));
Vue.component('image-thumb', require('./components/shared/ImageThumb.vue'));
Vue.component('tag', require('./components/shared/Tag.vue'));
const app = new Vue({ el: '#app' });
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