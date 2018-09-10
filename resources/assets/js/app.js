
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

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click', '.editBtn', function(){
    var data_text = $(this).data('text');
    var data_check = $(this).data('check');
    var data_img = $(this).data('img');
    var data_tinymce = $(this).data('tinymce');

    $.each(data_text, function(key, value){
        $('#edit_' + key).val(value);
    })

    $.each(data_check, function(key, value){
        var check = false;
        
        if(value == 1)
            check = true;

        $('#edit_' + key).attr("checked", check);
    })

    $.each(data_img, function(key, value){
        $('#edit_' + key).attr('src', value);
    })

    $.each(data_tinymce, function(key, value){
        tinyMCE.activeEditor.setContent(value);
    })
})

$(document).on('click', '.deleteBtn', function(){
    var id = $(this).data('id');
    $('#delete_id').val(id);
})

$(document).on('click', '.signBtn', function(){
    var id = $(this).data('id');
    $('#form_id').val(id);
})

$(document).on('change', '#sign_pilot', function(){
    var id = $(this).val();

    $.ajax({
        url: '/getPilot',
        method: 'POST',
        data: {id: id},
    }).done(function(response){
        $.each(response, function(key, value){
            $('#pilot_' + key).val(value);
        })
    });
})

$(document).on('change', '#sign_car', function(){
    var id = $(this).val();

    $.ajax({
        url: '/getCar',
        method: 'POST',
        data: {id: id},
    }).done(function(response){
        $.each(response, function(key, value){
            $('#car_' + key).val(value);
        })

        $.each(response, function(key, value){
            var check = false;
            
            if(value == 1)
                check = true;

            $('.car_' + key).attr("checked", check);
            $('.car_' + key).val(value);
        })
    });

    $.ajax({
        url: '/getKlasa',
        method: 'POST',
        data: {id: id},
    }).done(function(response){
        $('#sign_klasa').append(response);
    });
})

$(document).on('click', '.editSign', function(){
    var id = $(this).data('id');
    $('#sign_id').val(id);

    var data_text = $(this).data('text');
    var data_check = $(this).data('check');

    $.each(data_text, function(key, value){
        $('#' + key).val(value);

        if(key == 'klasa')
            $('#klasa option[value="'+value+'"]').attr('selected', 'selected');
    })

    $.each(data_check, function(key, value){
        var check = false;
        
        if(value == 1)
            check = true;

        $('#' + key).attr("checked", check);
    })
})

$(document).on('click', '.cancelSign', function(){
    var id = $(this).data('id');
    $('#cancel_id').val(id);
})

$(document).on('click', '.enableSign', function(){
    var id = $(this).data('id');
    $('#enable_id').val(id);
})

$(document).on('click', '.deleteSign', function(){
    var id = $(this).data('id');
    $('#delete_id').val(id);
})

var el = document.getElementsByClassName('sortable_items');
$.each(el, function(key, value){
    var sortable = Sortable.create(value,{
        animation: 150,
        onEnd: function (evt) {
            var order = sortable.toArray();

            $.ajax({
                url: '/update-position',
                method: 'POST',
                data: {order: order},
            }).done(function(response){
                console.log('ok');
            });
        },
    });
})

if(el.length){
    //Grouping
    var foo = document.getElementById("items");
    var items = Sortable.create(foo, { group: "items" });

    var bar = document.getElementById("dropdown");
    var dropped = Sortable.create(bar, { group: "items" });
}

$(document).on('click', '#generateFile', function(e){
    e.preventDefault();
    var order = dropped.toArray();
    $('#file_items').val(order);
    $(this).closest('form').submit();
})

$(document).ready(function() {  
    var editor_config = {
        path_absolute : "/",
        selector: "textarea.tinymce",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        }
    };

    var user_config = {
        selector: "textarea.tinymce_user",
        menubar:false,
        statusbar: true,
        plugins: [
            "advlist lists",
        ],
        toolbar: "bold italic | alignleft aligncenter | bullist numlist",
    };

    tinymce.init(editor_config);

    tinymce.init(user_config);

    $('.owl-carousel').owlCarousel({
        items: 5,
        loop: true,
        nav: false,
        navText: ['', ''],
        autoplay: true,
        autoplayTimeout: 8000,
        autoplayHoverPause: false,
        mouseDrag: true,
        dots: false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            576:{
                items:2,
            },
            768:{
                items:4,
            }
        }
    });

    $('#randomPartner').modal('show')
});

function initializeClock(id){
    var clock = $('#'+id);
    var end = clock.data('deadline');

    countdown.setLabels(
        ' | sek.| min.| godz.| dzień',
        ' | sek.| min.| godz.| dni',
        ' ',
        ' ',
        ' ',
        function(n){
            var formattedNumber = ("0" + n).slice(-2);
            return formattedNumber;
        }
    );
  var timeinterval = setInterval(function(){
    var time = countdown(new Date(end), null, countdown.DAYS|countdown.HOURS|countdown.MINUTES|countdown.SECONDS, 3);
    if(time.value < 0)
        clock.html(time.toString());
    else
        clock.html("00 min. 00 sek.");
  },1000);
}

initializeClock('counter');