$(document).ready(function () {


    // Select2
    // https://select2.org/
    // https://apalfrey.github.io/select2-bootstrap-5-theme/
    // ================================================================================================
    $('.select2-basico').select2({
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: 'Selecciona una opción',
        allowClear: true
    });


    // Multi select
    // Crea un select multiple "generico" para usar en aquellos selectores que tengan la clase "select-multiple"
    $('.select-multiple').select2({
        theme: 'bootstrap-5',
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        closeOnSelect: false,
        //selectionCssClass: 'select2--small',
        //dropdownCssClass: 'select2--small'
    });

    // Select multiple con la opcion de limpiar campos
    $( '.select-multiple-clear-field' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        //placeholder: $( this ).data( 'placeholder' ),
        placeholder: 'Seleccione una o varias opciones',
        closeOnSelect: false,
        allowClear: true,
    } );


    // Cuando cambia el departamento se debe actualizar el listado de localidades
    $('.select-departamento').change(onChangeDepartamento);

    // ===========================================================================================
    // Ocultar notificaciones luego de X segundos
    var duracion = 3000;
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
    // $('body').scrollspy({
    //     target: '#mainNav',
    //     offset: top
    // });


    // ===========================================================================================    
    // Resetea los campos select en los formularios
    // Issue: https://github.com/select2/select2/issues/363
    $("button.reset-selects").click(function () {
        $('select').val('').trigger('change');
    });


    // ===========================================================================================    
    // Copy y paste

    new ClipboardJS('.cnp');

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

    // ===========================================================================================    

    //Básico:
    //    $('#datetimepicker-simple').datetimepicker({locale: 'es'});

    // Solo tiempo:
    //    $('#datetimepicker-timeony').datetimepicker({format: 'LT'});



    // Input Mask
    // https://github.com/RobinHerbots/Inputmask
    // Ejemplo: https://robinherbots.github.io/Inputmask/
    $('.enmascarar-cuit').inputmask({
        //"mask": "*{1,3}[.*{8}]"
        "mask": "*{2}-*{8}-*{1}",
        "placeholder": "_"
    });
    $('.enmascarar-cuil').inputmask({
        //"mask": "*{1,3}[.*{8}]"
        "mask": "*{2}-*{8}-*{1}",
        "placeholder": "_"
    });

    // Máscara para fechas en formato dd/mm/yyyy:
    // https://github.com/RobinHerbots/Inputmask/blob/5.x/README_date.md
    $('.enmascarar-fecha').inputmask({
        "alias": "datetime",
        "mask": "99/99/9999",
        "placeholder": "dd/mm/yyyy",
    });

    // Máscara para fechas en formato yyyy:
    $('.enmascarar-fecha-anio').inputmask({
        "alias": "year",
        "mask": "9999",
        "placeholder": "YYYY"
    });

    $('.enmarcarar-nroliq').inputmask({
        "alias": "nroliq",
        "mask": "9",
        "placeholder": "d"
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

function btTableDefaultHeaderStyle(column) {
    return {
        // css: { 'font-weight': 'normal' },
       // classes: 'bg-pewter fw-bold text-brilliant-white'
    }
}
