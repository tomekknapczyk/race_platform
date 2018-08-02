
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

// const app = new Vue({
//     el: '#app'
// });

$(document).on('click', '.editBtn', function(){
    var data_text = $(this).data('text');
    var data_check = $(this).data('check');

    $.each(data_text, function(key, value){
        $('#edit_' + key).val(value);
    })

    $.each(data_check, function(key, value){
        var check = false;
        
        if(value == 1)
            check = true;

        $('#edit_' + key).attr("checked", check);
    })
})

$(document).on('click', '.deleteBtn', function(){
    var id = $(this).data('id');
    $('#delete_id').val(id);
})