/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//  import {Tooltip,Toast,Popover} from 'bootstrap';
require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

var $  = require( 'jquery' );

// import { createPopper } from '@popperjs/core';
// const popcorn = document.querySelector('#popcorn');
// const tooltip = document.querySelector('#tooltip');
// createPopper(popcorn, tooltip, {
//   placement: 'top',
// });
import {Tooltip,Toast,Popover} from 'bootstrap';
// import $ from 'jquery';
// import 'jquery-ui';
// global.$ = global.jQuery = $;
// window.$ = window.jQuery = $;
// var dt = require( 'datatables.net' )();
// require('jquery/dist/jquery.js');
// require('jquery/dist/jquery.min.js');
// window.$ = window.jQuery = $;

// import jQuery from 'jquery';
// window.$ = jQuery;

// require('daterangepicker/daterangepicker.js');
// require('daterangepicker/daterangepicker.css');

require('jquery-ui/ui/widgets/datepicker.js');
// require('daterangepicker/daterangepicker.js');
// require('daterangepicker/daterangepicker.css');

require('jquery-ui-daterangepicker/jquery.comiseo.daterangepicker.css')
require('jquery-ui-daterangepicker/jquery.comiseo.daterangepicker.js')
require('daterangepicker/daterangepicker.js')
require('daterangepicker/daterangepicker.css')
require('jquery-validation/dist/jquery.validate.js')
 require('jquery-ui/ui/widgets/autocomplete.js');
require('select2/dist/js/select2.js')
require('select2/dist/css/select2.css')

$(document).ready(function(){
$('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    var format_start=start.format('MM-DD-YYYY');
    var format_end=end.format('MM-DD-YYYY');
    // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    window.location.href='/home?start='+format_start+'&end='+format_end;

});

// $("form#shipper_add_form").validate({
      
//     submitHandler: function (form) {
      
//       var form = $("form#shipper_add_form");
//       var url = form.attr('action');
      
//       form.find('button[type="submit"]').attr('disabled', true);
//       $.ajax({
//           method: "POST",
//           url: url,
//           dataType: 'json',
//           data: $(form).serialize(),
//           success: function(data){
//               $('.shipper_modal').modal('hide');
//               if( data.success){
//                   toastr.success(data.msg);
                 
//               } else {
//                   toastr.error(data.msg);
//               }
//           }
//       });
//       return true;
//     }
//   });

});
