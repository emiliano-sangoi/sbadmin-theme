$(document).ready(function () {

    // Select2
    // https://select2.org/
    // Definir Bootstrap por default para todos los selects:
    //https://www.npmjs.com/package/select2-theme-bootstrap4
    $.fn.select2.defaults.set("theme", "bootstrap");
    $('.select2-basico').select2({
        //   placeholder: 'Elija una opción',
        //allowClear: true,
    });

    // Cuando cambia el departamento se debe actualizar el listado de localidades
    $('.select-departamento').change(onChangeDepartamento);

    // ===========================================================================================
    // Ocultar notificaciones luego de X segundos
    var duracion = 4000;
    setTimeout(function () {
        $('.auto-dismiss-notification').fadeOut(600);
    }, duracion);

    // ===========================================================================================
    // To Top Button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.to_top_button:hidden').stop(true, true).fadeIn();
        } else {
            $('.to_top_button').stop(true, true).fadeOut();
        }
    });

    $(function () {
        $(".to_top_button").click(function () {
            $("html,body").animate({
                scrollTop: $("body").offset().top
            }, "1000");
            return false;
        });
    });

    // ===========================================================================================
    // Utilizado en usuario responsable para editar el correo electrónico
    $('.back-btn').click(function (event) {
        event.preventDefault();
        history.back();
    });


    // ===========================================================================================    
    // Smooth scrolling using jQuery easing
    var top = 75;
    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top - top)
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });

    // Closes responsive menu when a scroll trigger link is clicked
    $('.js-scroll-trigger').click(function () {
        $('.navbar-collapse').collapse('hide');
    });

    // Activate scrollspy to add active class to navbar items on scroll
    $('body').scrollspy({
        target: '#mainNav',
        offset: top
    });


    // ===========================================================================================    
    // Resetea los campos select en los formularios
    // Issue: https://github.com/select2/select2/issues/363
    $("button.reset-selects").click(function () {
        $('select').val('').trigger('change');
    });


    // ===========================================================================================    
    // Tooltips

    //Activar tooltips:
    //$('[data-toggle="tooltip"]').tooltip();

    $('.cnp').hover(function (event) {
        $(this).tooltip('hide')
                .attr('data-original-title', 'Copiar al portapapeles')
                .tooltip('show');
    });

    $('.cnp').click(function (event) {
        $(this).tooltip('hide')
                .attr('data-original-title', 'Copiado!')
                .tooltip('show');
        //$(event.target).tooltip('Copiado');
    });

    /*var itemActivo = null;
     $("#indice .dropdown-item").click(function(event){
     //console.log("holis");
     if(itemActivo !== null){
     itemActivo.removeClass('active');
     }
     
     itemActivo = $(event.target);
     //$("#indice .dropdown-menu .dropdown-item").removeClass('active');
     itemActivo.addClass('active');
     });*/


});

/**
 * Actualiza el select de localidades cuando cambia un departamento.
 *
 * @param  event Informacion del evento
 */
function onChangeDepartamento(event) {

    var select = $(event.target);

    //Actualizar path con el id del dpto elegido
    var path = APP.paths.GET_LOCALIDADES.replace('ID_DPTO', select.val());

    $.getJSON(path, function (data) {
        var items = [];
        $.each(data, function (key, val) {
            items.push("<option value='" + key + "'>" + val + "</option>");
        });

        //cargar localidades ...
        $('.select-localidades').html(items.join(""));
    });

}