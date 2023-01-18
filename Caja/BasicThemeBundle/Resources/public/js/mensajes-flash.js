/**
 * Permite crear un mensaje flash mediante JS
 *
 * @param msg string
 * @param type string "success", "danger", "warning", "info", "light"
 * @param auto_dismiss boolean
 * @param msg_css CSS que se aplicara al mensaje
 * @param container Contenedor en la cual se va a insertar la notificacion
 */
function addFlash(msg, type = "success", auto_dismiss = true, msg_css = '', container='#notificaciones'){

    var dismiss = auto_dismiss ? 'auto-dismiss-notification' : '';

    var html = "<div class='alert alert-" + type + " alert-dismissible fade show " + dismiss + "' role='alert'>";

    html += "<span class='" + msg_css + "'>" + msg + '</span>';
    html += "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";

    var oHtml = $($.parseHTML(html));

    if(auto_dismiss) {
        setTimeout(function () {
            oHtml.fadeOut(900, function () {
                $(this).remove();
            });
        }, 7000);
    }

    $(container).append(oHtml);
}