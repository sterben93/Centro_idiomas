function agregarPublicaciones() {
    $.post("http://localhost/Backend/webServicesPublicaciones.php", {
            opcion: 2
        }
        , function (resultado) {
            var $publicaciones = JSON.parse(resultado);
            agregarContenido($publicaciones);
            cargarComportamientos();
        }
    );
}

function agregarContenido($publicaciones) {
    $.each($publicaciones, function (index, publicacion) {
        var elemTr = $("<tr/>", {
            'id': index
        });
        var elemTd = $("<td/>", {
            'html': publicacion.idPublicaciones
        });
        var elemTd2 = $("<td/>", {
            'html': publicacion.Titulo
        });
        var elemTd3 = $("<td/>", {
            'html': publicacion.Contenido
        });
        var elemTd4 = $("<td/>", {
            'html': publicacion.Imagen
        });
        var elemTd7 = $("<td/>");
        var elemSpan = $('<span/>', {
            'class': 'glyphicon glyphicon-edit'
        });
        var elemSpan2 = $('<span/>', {
            'class': 'glyphicon glyphicon-remove'
        });
        var elemButton = $('<button/>', {
            'class': 'btn btn-default eliminar'
            , 'val': publicacion.idPublicaciones + ' ' + publicacion.Imagen
            , 'type': 'button'
            , 'data-toggle': 'modal'
            , 'data-target': '#modalEliminar'
        });
        var elemButton2 = $('<button/>', {
            'class': 'btn btn-default editar'
            , 'val': index
            , 'type': 'button'
            , 'data-toggle': 'modal'
            , 'data-target': '#modalEditar'
        });
        elemButton.append(elemSpan2);
        elemButton2.append(elemSpan);
        elemTd7.append(elemButton);
        elemTd7.append(elemButton2);
        elemTr.append(elemTd);
        elemTr.append(elemTd2);
        elemTr.append(elemTd3);
        elemTr.append(elemTd4);
        elemTr.append(elemTd7);
        $('#listaPublicaciones').append(elemTr);
    })
}

function cargarComportamientos() {
    $('#eliminar').click(function () {
        $.post("http://localhost/Backend/webServicesPublicaciones.php", {
            opcion: 3
            , idPublicaciones: $cookie('id')
        }, function (resp) {
            window.location.href = 'http://localhost/Centro_Idiomas/idiomas.html';
            window.location.reload;
        });
    });
    $('.eliminar').click(function () {
        alert(this.value);
        $cookie('id', this.value);
    });

    $('.editar').click(function () {
        var elemento = 'tr#' + this.value + ' > td';
        var inputEdit = ["form#formUpdate > div > #idPublicaciones"



            , "form#formUpdate > div > input#Titulo"



            , "form#formUpdate > div > textarea#Contenido"



            , ];
        $(elemento).each(function (number, td) {
            if (number < 4) {
                alert(td.innerHTML);
                $(inputEdit[number]).val(td.innerHTML);
            }
        });
    });
    $("#ocultar").click(function () {
        if (this.value === "1") {
            $("#lista").hide();
            this.innerHTML = 'Ver Lista <span class="glyphicon glyphicon-eye-open"></span>';
            this.value = "2";
        } else {
            $("#lista").show();
            this.innerHTML = 'Ocultar Lista <span class="glyphicon glyphicon-eye-close"></span>';
            this.value = "1";
        }


    });
    $("#id").val($cookie("nombre"))
}
$(document).ready(function ($) {
    'use strict';
    agregarPublicaciones();
    $('input[type=file]').change(function () {
        var x = this;

  if ('files' in x) {
            if (x.files.length == 0) {
                txt = "Select one or more files.";
            } else {
                for (var i = 0; i < x.files.length; i++) {
                    var file = x.files[i];
                    if(200000<file.size){
                        alert("Excedio tamaño del archivo el maximo es 200 kilobytes")
                    }
                    if (!(/\.(jpg|png|jpeg)$/i).test(file.name)) {
                        alert('Formato no valido');
                    }
                }
            }
        }
    });
});
