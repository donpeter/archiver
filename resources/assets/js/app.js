
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./../bower/jquery-slimscroll/jquery.slimscroll.min')
require('./../bower/sweetalert/dist/sweetalert.min')
require('./../bower/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker')



window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('document', require('./components/Document.vue'));
Vue.component('document-list', require('./components/DocumentList.vue'));
Vue.component('document-view', require('./components/DocumentView.vue'));

const app = new Vue({
  el: '#app',
  data: {
    message: 'Hello Vue!',
    signedDate: null,
  },
  methods: {
    onView: function (item) {
      console.log(item);
    },
    onFilter: function () {
      console.log(this.signedDate);
    }
        
          
  },
  mounted: function(){
    $('.datetimepicker').datetimepicker({
        locale: 'en',
        format: 'DD/MM/YYYY'
    });
     $(".datetimepicker").on("dp.change", function (e) {
        console.log('Date change: ', e.date.format('DD/MM/YY'));
            this.signedDate = e.date.format('L');
        }.bind(this));
    
  }
});
