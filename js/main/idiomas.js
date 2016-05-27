/*Global var $*/
function agregarElementos($idiomas) {
    $.each($idiomas, function (index, idioma) {
        var elemTr = $("<tr/>", {'id': index});
        var elemTd = $("<td/>", {'html': idioma.idIdiomas});
        var elemTd2 = $("<td/>", {'html': idioma.Idioma});
        var elemTd3 = $("<td/>", {'html': idioma.Niveles});
        var elemTd4 = $("<td/>", {'html': idioma.Objetivo});
        var elemTd5 = $("<td/>", {'html': idioma.Perfil_Ingreso});
        var elemTd6 = $("<td/>", {'html': idioma.Perfil_Egreso});
        var elemTd6a = $("<td/>", {'html': idioma.Imagen});
        var elemTd7 = $("<td/>");
        var elemSpan = $('<span/>', {'class': 'glyphicon glyphicon-edit'});
        var elemSpan2 = $('<span/>', {'class': 'glyphicon glyphicon-remove'});
        var elemButton = $('<button/>', {
            'class': 'btn btn-default eliminar',
            'val': idioma.idIdiomas + ' ' + idioma.Imagen,
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
        elemTr.append(elemTd3);
        elemTr.append(elemTd4);
        elemTr.append(elemTd5);
        elemTr.append(elemTd6);
        elemTr.append(elemTd6a);
        elemTr.append(elemTd7);
        $('#listaIdiomas').append(elemTr);
    });
}

function cargarComportamientos() {
    $('#eliminar').click(function () {
        $.post("http://localhost/Backend/webServicesIdiomas.php", {
            salida: 3,
            idIdiomas: $cookie('id')
        }, function (resp) {
            window.location.href = 'http://localhost/Centro_Idiomas/idiomas.html';
            window.location.reload;
        });
    });
    $('.eliminar').click(function () {
        $cookie('id', this.value);
    });

    $('.editar').click(function () {
        var elemento = 'tr#' + this.value + ' > td';
        var inputEdit = ["form#formUpdate > div > input#idIdiomas",
            "form#formUpdate > div > input#idioma",
            "form#formUpdate > div > #niveles",
            "form#formUpdate > div > #objetivo", "form#formUpdate > div > #perfil_ingreso", "form#formUpdate > div > #prefil_egreso"];
        $(elemento).each(function (number, td) {
            if (number < 6) {
                $(inputEdit[number]).val(td.innerHTML);
            }
        });
    });
}

function agregarContenido() {
    $.post("http://localhost/Backend/webServicesIdiomas.php", {salida: 4},
    function (resultado) {
        var $idiomas = JSON.parse(resultado);
        agregarElementos($idiomas);
        cargarComportamientos();
    }
    );
}

$(document).ready(function ($) {
    'use strict';
    agregarContenido();
});
