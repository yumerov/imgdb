// require('./bootstrap');

// window.Vue = require('vue');
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
// const app = new Vue({ el: '#app' });
// require('./bulma-extensions');

require('select2');
window.$ = window.jQuery = require('jquery');

$(document).ready(() => {
    function readURL(input) {
      if (input.files && input.files[0]) {
        let reader = new FileReader();
        reader.onload = function(e) {
          $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }

    $('select').select2({
        theme: "flat"
    });

    $('input[type="file"]').change((event) => {
        let target = event.target;
        let name = target.files[0].name;
        $(target).siblings('.file-name').html(name);
        readURL(target);
    });
});