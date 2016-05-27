function agregarPublicaciones() {
    $.post("http://localhost/Backend/webServicesPublicaciones.php", {
        opcion: 2
    }
        , function (resultado) {
            var $publicaciones = JSON.parse(resultado);
            agregarContenidoPublicaiones($publicaciones);
        }
    );
}

function agregarContenidoPublicaiones(publicaciones) {
    $.each(publicaciones, function (index, publicacion) {
        var elemDiv = $('<div/>', {
            'class': 'col-xs-12 col-sm-12 col-md-3 col-lg-3'
        });
        var elemDiv2 = $('<div/>', {
            'class': 'thumbnail'
        });
        var elemIMg = $('<img/>', {
            'src': publicacion.Imagen
            , 'alt': 'noticia ' + index
            , 'class': 'imagen',
            'height': '200px'
        });
        var elemDiv3 = $('<div/>', {
            'class': 'caption', height: '200'
        });
        var elemH3 = $('<h3/>', {
            'html': publicacion.Titulo.substring(0, 15) + '...'
            , class: 'container-fluid center'
        });
        var elemP = $('<p/>', {
            'html': publicacion.Contenido.substring(0, 60) + "...", 'class': 'container-fluid text-justify'
        });
        var elemP2 = $('<p/>');
        var elemA = $('<a/>', {
            'html': 'Ver mas..'
            , 'href': "http://localhost/Centro_Idiomas/publicacion.html#"+publicacion.idPublicaciones
        });
        elemDiv2.append(elemIMg);
        elemP2.append(elemA);
        elemDiv3.append(elemH3);
        elemDiv3.append(elemP);
        elemDiv3.append(elemP2);
        elemDiv2.append(elemDiv3);
        elemDiv.append(elemDiv2);
        $('#publicaciones').append(elemDiv);
    })
}

function crearElemento(idioma, classB) {
    var elemA = $("<a/>", {
        'href': "http://localhost/Centro_Idiomas/idioma.html#" + idioma.idIdiomas
    });
    var elemDiv = $("<div/>", {
        'class': classB
    });
    var elemDiv2 = $("<div/>", {
        'class': "center"
    });
    var elemImg = $('<img/>', {
        'src': "http://localhost/Backend/" + idioma.Imagen
        , 'class': "img-rounded"
        , 'width': "80"
        , 'height': "80"
    });
    var elemBr = $('<br/>');
    var elemH2 = $('<h2/>', {
        'html': idioma.Idioma
    })
    elemDiv2.append(elemImg);
    elemDiv2.append(elemBr);
    elemDiv2.append(elemH2);
    elemDiv.append(elemDiv2);
    elemA.append(elemDiv);
    return elemA;
}

function agregarRestante(idiomas, restante, long) {

    switch (restante) {
        case 1:
            var fila = $('<div/>', {
                'class': 'row'
            });
            fila.append(crearElemento(idiomas[long], "col-md-offset-4 col-md-4 col-sm-6"));
            $("#listaIdiomas").append(fila);
            break;
        case 2:
            var fila = $('<div/>', {
                'class': 'row'
            });
            fila.append(crearElemento(idiomas[long++], "col-md-4 col-sm-6"));
            fila.append(crearElemento(idiomas[long], "col-md-offset-4 col-md-4 col-sm-6"));
            $("#listaIdiomas").append(fila);
            break;
    }
}

function agregarContenidoIdiomas(idiomas) {
    var row = idiomas.length / 3;
    var restante = idiomas.length % 3;
    var long = 0;
    for (var i = 0; i < parseInt(row); i++) {
        var fila = $('<div/>', {
            'class': 'row'
        });
        fila.append(crearElemento(idiomas[long++], "col-md-4 col-sm-6"));
        fila.append(crearElemento(idiomas[long++], "col-md-4 col-sm-6"));
        fila.append(crearElemento(idiomas[long++], "col-md-4 col-sm-6"));
        $("#listaIdiomas").append(fila);
    }
    agregarRestante(idiomas, restante, long);
}

function agregarIdiomas() {
    $.post("http://localhost/Backend/webServicesIdiomas.php", {
            salida: 4
        }
        , function (resultado) {
            var idiomas = JSON.parse(resultado);
            agregarContenidoIdiomas(idiomas);
        }
    );
}
$(document).ready(function ($) {
    'use strict';
    agregarPublicaciones();
    agregarIdiomas();
});
