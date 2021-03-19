$(document).ready(function () {

//    $('.confirmar').click(function () {
//
//        bootbox.confirm({
//            message: "¿Esta seguro que desea borrar el Organismo Tierra Plana?",
//            centerVertical: true,
//            buttons: {
//                confirm: {
//                    label: 'Dale nomás',
//                    className: 'btn-success'
//                },
//                cancel: {
//                    label: 'No',
//                    className: 'btn-danger'
//                }
//            },
//            callback: function (result) {
//                console.log('This was logged in the callback: ' + result);
//            }
//        });
//
//    });



    $('.pedir-confirmacion').click(function (event) {
        event.preventDefault();

        var element = $(event.target);
        var message = element.data('dialog_message');
        var title = element.data('dialog_title');

        var yesCallback = function (event) {
            element.parent('form').submit();
        }

        var dialog_config = getDialogConfirmConfig(title, message, yesCallback, null);

//        var dialog_config = {
//            size: "small",
//            title: title ? title : 'Borrar registro',
//            message: msg ? msg : '¿Esta seguro que desea borrar este registro?',
//            backdrop: true,
//            centerVertical: true,
//            buttons: {
//                confirm: {
//                    label: 'Confirmar',
//                    className: 'btn-primary'
//                },
//                cancel: {
//                    label: 'Cancelar',
//                    className: 'btn-secondary'
//                }
//            },
//            callback: function (result) {
//                console.log(result, element.parent('form'));
//                if (result === true) {
//                    
//                }
//
//            }
//        };

        bootbox.confirm(dialog_config);
    });


    $('.pedir-confirmacion-alt').click(function (event) {
        event.preventDefault();

        var element = $(event.target);
        var message = element.data('dialog_message');
        var title = element.data('dialog_title');

        var yesCallback = function (event) {
            var href = element.attr('href');
            window.location.href = href;
        }

        var dialog_config = getDialogConfirmConfig(title, message, yesCallback, null);

        bootbox.confirm(dialog_config);
    });

    $('.pedir-confirmacion-baja-aportante').click(function (event) {
        event.preventDefault();

        // console.log("hola");

        //return;

        var element = $(event.target);

        var dialog_config = {
            size: "large",
            title: 'Confirmar baja de aportante',
            message: $('#form-motivo-baja').html(),
            buttons: {
                confirm: {
                    label: 'Confirmar',
                    className: 'btn-primary'
                },
                cancel: {
                    label: 'Cancelar',
                    className: 'btn-secondary'
                }
            },
            callback: function (result) {

                if (result) {
                    var form = $('.bootbox-body form');
                    form.submit();
                }

            }
        };

        bootbox.confirm(dialog_config);
    });

    $('.on-cerrar-sesion').click(function (event) {
        event.preventDefault();

        var anchor = $(event.target);
        var dialog_config = {
            size: "small",
            title: "Cerrar sesión",
            message: "¿Esta seguro que desea salir del sistema?",
            callback: function (result) {
                var href = anchor.attr('href');
                if (result && href !== '#' && typeof href === 'string') {
                    window.location.href = href;
                }

            }
        };
        bootbox.confirm(dialog_config);
    });



    $('#card-header-action').click(function (event) {
        /*  
         event.preventDefault();
         
         var msg = $(event.target).data('msg');*/

        /*  var msg = "<p>Estos datos fueron obtenidos del " +
         "<a href='{{ HREF }}' target='_blank'>" +
         'Sistema de Identificaci&oacute;n Ciudadana' +
         "</a>.</p>" +
         "<p>Es importante que mantenga esta información actualizada ya que será utilizada como contacto en caso de ser necesario.</p>";
         msg = msg.replace('{{ HREF }}', APP.config.global_id_ciud_url );*/
        /*
         var dialog_config = {
         title: 'Ayuda',
         message: msg,
         };
         
         bootbox.dialog(dialog_config);*/

    });

});

function getDialogConfirmConfig(title = 'Confirmar borrado', message = '¿Esta seguro que desea borrar este registro?', yesCallback, noCallback) {
    return {
        size: "small",
        title: title,
        message: message,
        backdrop: true,
        centerVertical: true,
        buttons: {
            confirm: {
                label: 'Confirmar',
                className: 'btn-primary'
            },
            cancel: {
                label: 'Cancelar',
                className: 'btn-secondary'
            }
        },
        callback: function (result) {
            //console.log(result, element.parent('form'));
            if (result === true) {
                if (typeof yesCallback == 'function') {
                    yesCallback();
                }
            } else {
                if (typeof noCallback == 'function') {
                    noCallback();
                }
            }

        }
    };
}
