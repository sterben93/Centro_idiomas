$(document).ready(function ($) {
    $.post("http://localhost/Backend/webServicesAdministrador.php", {
        salida: 6
    }, function (resultado) {
        $administradores = JSON.parse(resultado);
        $.each($administradores, function (index, administrador) {
            var elemTr = $("<tr/>");
            var elemTD1 = $("<th/>", {
                "html": administrador.idAdministrador
            });
            var elemTD2 = $("<th/>", {
                "html": administrador.nombreCompleto
            });
            var elemTD3 = $("<th/>", {
                "html": administrador.Correo
            });
            var elemTD4 = $("<th/>");
            var elemButton = $('<button/>', {
                class: 'btn btn-default aceptar'
                , val: administrador.idAdministrador
                , 'type': 'button'
                , 'data-toggle': 'modal'
                , 'data-target': '#modalAceptar'
            });
            var elemSpan = $('<span/>', {
                class: 'glyphicon glyphicon-ok'
            });
            var elemButton2 = $('<button/>', {
                class: 'btn btn-default eliminar'
                , val: administrador.idAdministrador
                , 'type': 'button'
                , 'data-toggle': 'modal'
                , 'data-target': '#modalEliminar'
            });
            var elemSpan2 = $('<span/>', {
                class: 'glyphicon glyphicon-remove'
            });

            elemButton.append(elemSpan);
            elemButton2.append(elemSpan2);
            elemTD4.append(elemButton);
            elemTD4.append(elemButton2);
            elemTr.append(elemTD1);
            elemTr.append(elemTD2);
            elemTr.append(elemTD3);
            elemTr.append(elemTD4);
            $('#listaAdmin').append(elemTr);
        });
        $('#aceptar').click(function () {
            $.post("http://localhost/Backend/webServicesAdministrador.php", {
                salida: 4
                , idAdmin: $cookie('idAdmin')
            }, function (resp) {
                window.location.href = 'http://localhost/Centro_Idiomas/administrador.html';
                window.location.reload;
            });

        });
        $('#eliminar').click(function () {
            $.post("http://localhost/Backend/webServicesAdministrador.php", {
                salida: 7
                , idAdmin: $cookie('idAdmin')
            }, function (resp) {
                window.location.href = 'http://localhost/Centro_Idiomas/administrador.html';
                window.location.reload;
            });
        });
        $(".aceptar").click(function (){
            $cookie('idAdmin', this.value);
        });
        $(".eliminar").click(function (){
            $cookie('idAdmin', this.value);
        });
    });
});
