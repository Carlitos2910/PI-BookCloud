// Añadimos la libreria para la funcionalidad de las tablas.
$(document).ready(function(){
    $('#myTable').DataTable();
})


// Le añadimos una clase de FA, para que tenga movimiento el icono.
$("#dark-mode").hover(function(){
    $("#dark-mode i").addClass('fa-spin');
}, function(){
    $("#dark-mode i").removeClass('fa-spin');
});


function dark_mode(){
    document.documentElement.classList.toggle('dark-mode');

    if ($("#dark-mode i.fa-sun")[0]) {
        $("#dark-mode i").removeClass('fa-sun');
        $("#dark-mode i").addClass('fa-moon');
    } else {
        $("#dark-mode i").removeClass('fa-moon');
        $("#dark-mode i").addClass('fa-sun');
    }
}


function mostrar_dropdown_content() {
    var dropdown = document.getElementById("myDropdown");
    dropdown.classList.toggle("show");
}


$(document).ready(function(){

    // Creamos las variables de los botones y el formulario.
    var btn = $('#gototop');
    // Al hacer scroll ocultamos el boton dependiendo de la altura en la que se encuentre.
    $(window).scroll(function() {
        if ($(window).scrollTop() > 200) {
            btn.addClass('show');
        } else {
            btn.removeClass('show');
        }
    });
    // Al hacer click al boton del scroll subimos hasta arriba de la pantalla.
    btn.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop:0
        }, '300');
    });


    var btn_contact_form = $('#btn_contact_form');
    var contact_form = $('#contact_form');
    // Comprobamos si el formulario está oculto o no, para mostrarlo.
    btn_contact_form.on('click', function() {
        contact_form.toggle();
    });
    contact_form.find('#contact_form_close').on('click', function() {
        contact_form.hide();
    });
    $(window).on('click', function(event) {
        if (!$(event.target).closest('#container_contact_form').length) {
            contact_form.hide();
        };
    });

    
    var btn_valorar = $('#btn_valorar');
    var valoration_form = $('#valoration_form');
    var img_toggle = $('.libro_image img');
    btn_valorar.on('click', function() {
        valoration_form.toggle();
        img_toggle.toggle();
    });
    valoration_form.find('#valoration_form_close').on('click', function() {
        valoration_form.hide();
        img_toggle.toggle();
    });
    $(window).on('click', function(event) {
        if($(valoration_form).is(':visible')) {
            if (!$(event.target).closest(valoration_form).length && !$(event.target).closest(btn_valorar).length) {
                valoration_form.hide();
                img_toggle.show();
            };
        }
    });


    var main = $('main');
    var slider_container = $('#slider_container');
    var form = $('form');
    if(main.has(slider_container).length > 0 || main.has(form).length > 0) {
        main.css('background-color', 'transparent');
    }






    // En la pantalla de autores vamos a ponerle de fondo a cada div la imagen de su autor.
    // $('.autores .grid-container .container').each(function(){
    //     var nombre = $(this).find('.nombre').text();
    //     // var nombre = nombre.replace(/\s/g, '%20');
    //     var nombre = nombre.replace(/\s/g, '');
    //     var imagen = nombre + '.png';
    //     $(this).css('background-image', 'url(../Images/Autores/' + imagen + ')'); 
    // })

    // $('.libros .grid-container .container').each(function(){
    //     var titulo = $(this).find('.titulo').text();
    //     var titulo = titulo.replace(/\s/g, '%20');
    //     var imagen = titulo + '.png';
    //     $(this).css('background-image', 'url(../Images/Libros/' + imagen + ')'); 
    // })

});





// if($('main').find('.userform')){
// }else{
//     $('main').css('background-color', 'transparent');
// }
