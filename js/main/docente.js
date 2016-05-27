/*Global var $*/
function agregarElementos(docentes) {
    $.each(docentes, function (index, docente) {
        var elemTr = $("<tr/>", { 'id': index });
        var elemTd = $("<td/>", { 'html': docente.idDocente });
        var elemTd2 = $("<td/>", { 'html': docente.Nombre });
        var elemTd2a = $("<td/>", { 'html': docente.Apellidos });
        var elemTd3 = $("<td/>", { 'html': docente.Correo });
        var elemTd4 = $("<td/>", { 'html': docente.Telefono });
        var elemTd7 = $("<td/>");
        var elemSpan = $('<span/>', { 'class': 'glyphicon glyphicon-edit' });
        var elemSpan2 = $('<span/>', { 'class': 'glyphicon glyphicon-remove' });
        var elemButton = $('<button/>', {
            'class': 'btn btn-default eliminar',
            'val': docente.idDocente,
            'type': 'button',
            'data-toggle': 'modal',
            'data-target': '#modalEliminar'
        });
        var elemButton2 = $('<button/>', {
            'class': 'btn btn-default editar',
            'val': index,
            'type': 'button',
            'data-toggle': 'modal',
            'data-target': '#modalEditar'
        });
        elemButton.append(elemSpan2);
        elemButton2.append(elemSpan);
        elemTd7.append(elemButton);
        elemTd7.append(elemButton2);
        elemTr.append(elemTd);
        elemTr.append(elemTd2);
        elemTr.append(elemTd2a);
        elemTr.append(elemTd3);
        elemTr.append(elemTd4);
        elemTr.append(elemTd7);
        $('#listaDocentes').append(elemTr);
    });
}

function cargarComportamientos() {
    $('#eliminar').click(function () {
        $.post("http://localhost/Backend/webServicesDocentes.php", {
            salida: 3,
            idDocente: $cookie('id')
        }, function (resp) {
            window.location.href = 'http://localhost/Centro_Idiomas/docentes.html';
            window.location.reload;
        });
    });

    $('.eliminar').click(function () {
        $cookie('id', this.value);
    });

    $('.editar').click(function () {
        var elemento = 'tr#' + this.value + ' > td';
        var inputEdit = ["form#formUpdate > div > input#idDocente",
            "form#formUpdate > div > input#nombre",
            "form#formUpdate > div > input#Apellidos",
            "form#formUpdate > div > input#Correo",
            "form#formUpdate > div > input#Telefono"];
        $(elemento).each(function (number, td) {
            if (number < 6) {
                $(inputEdit[number]).val(td.innerHTML);
            }
        });
    });
}

function agregarContenido() {
    $.post("http://localhost/Backend/webServicesDocentes.php", { salida: 4 },
        function (resultado) {
            var $docentes = JSON.parse(resultado);
            agregarElementos($docentes);
            cargarComportamientos();
        }
    );
}

$(document).ready(function ($) {
    'use strict';
    agregarContenido();
    $('input').change(cambioInput);
    $('#bt_Inicio').click(verificaInput);
});


