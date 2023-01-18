$(document).ready(function () {


//    $('#datetimepicker1').datetimepicker();


    // Select2
    // https://select2.org/
    // Definir Bootstrap por default para todos los selects:
    //https://www.npmjs.com/package/select2-theme-bootstrap4
    $.fn.select2.defaults.set("theme", "bootstrap4");


    $('.select2-basico').select2({
        theme: 'bootstrap4',
//        placeholder: " ",
        allowClear: true
    });
    
    // ================================================================================================
    // Multi select    
    // Crea un select multiple "generico" para usar en aquellos selectores que tengan la clase "select-multiple"
    crearSelectMultiple('.select-multiple', false, null);
    crearSelectMultiple('.select-multiple-con-filtro', true, null);


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


function crearSelectMultiple(selector, conFiltro, numberDisplayed){
    
    if(numberDisplayed === null || typeof numberDisplayed !== 'number' || numberDisplayed <= 0){
        numberDisplayed = 3;
    }    
    
    var fButtonText = function (options) {
        if (options.length === 0) {
            return 'Ninguno seleccionado';
        } else if (options.length > numberDisplayed) {
            return options.length + ' seleccionados';
        } else {
            var selected = [];
            options.each(function () {
                selected.push([$(this).text(), $(this).data('order')]);
            });

            selected.sort(function (a, b) {
                return a[1] - b[1];
            });

            var text = '';
            for (var i = 0; i < selected.length; i++) {
                text += selected[i][0] + ', ';
            }

            return text.substr(0, text.length - 2);
        }
    };
    
    var conf = {
        buttonWidth: '100%',
        allSelectedText: 'Todas las opciones seleccionadas',
        numberDisplayed: numberDisplayed,
       // includeResetOption: true,
       // includeResetDivider: true,
       // resetText: 'Reiniciar',
        buttonTextAlignment: 'left',
        buttonText: fButtonText
    };
    
    if(conFiltro){
        conf.enableFiltering = true;
        conf.filterPlaceholder = 'Filtrar ...';
    }

    $(selector).multiselect(conf);
    
    
    
}