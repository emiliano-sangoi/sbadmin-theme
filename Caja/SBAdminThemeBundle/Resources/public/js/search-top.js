$(document).ready(function () {

    var data = [
        {
            "text": "Inicio",
            "children": [
                {
                    "id": 1,
                    "text": "Panel",
                    "url": "www.google.com"
                },
                {
                    "id": 2,
                    "text": "Option 1.2",
                    "url": "www.google.com"
                }
            ]
        },
        {
            "text": "Group 2",
            "children": [
                {
                    "id": 3,
                    "text": "Option 2.1",
                    "url": "www.google.com"
                },
                {
                    "id": 4,
                    "text": "Option 2.2",
                    "url": "www.google.com"
                }
            ]
        }
    ];

    var navbarSearchFormInput = $('#navbarSearchForm input');
    navbarSearchFormInput.select2({
        theme: "bootstrap-5",
        //width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: 'Buscar sección ...',
        allowClear: true,
        // disabled: disable_select_persona,
        data: data,
        // placeholder: 'Nombre del cargo',
        //minimumInputLength: 2,
    });

    navbarSearchFormInput.on('select2:select', function (e) {
        var data = e.params.data;
        console.log(data);
    });

});
