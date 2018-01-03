import vSelect from 'vue-select'
import VeeValidate from 'vee-validate';
Vue.use(VeeValidate);
Vue.component('v-select', vSelect)
Vue.component('pagination', require('laravel-vue-bulma-pagination'));

Vue.component('app', require('./components/App.vue'));
Vue.component('app-header', require('./components/Header.vue'));
Vue.component('app-footer', require('./components/Footer.vue'));
Vue.component('nav-item', require('./components/NavItem.vue'));
Vue.component('home-main', require('./components/mains/Home.vue'));

Vue.component('image-thumb', require('./components/shared/ImageThumb.vue'));
Vue.component('tag', require('./components/shared/Tag.vue'));
