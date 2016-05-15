function agregarPublicaciones() {
    $.post("http://localhost/Backend/webServicesPublicaciones.php", {opcion: 2},
        function (resultado) {
            var $publicaciones = JSON.parse(resultado);
            agregarContenido($publicaciones);
        }
    );
}

function agregarContenido($publicaciones) {
    $.each($publicaciones, function (index, publicacion) {
        var elemDiv = $('<div/>',{'class':'col-xs-12 col-sm-12 col-md-3 col-lg-3'});
        var elemDiv2 = $('<div/>',{'class':'thumbnail'});
        var elemIMg = $('<img/>',{'src':publicacion.Imagen, 'alt':'noticia '+index, 'class':'imagen'});
        var elemDiv3 = $('<div/>',{'class':'caption'});
        var elemH3 = $('<h3/>',{'html':publicacion.Titulo,class:'container'});
        var elemP = $('<p/>',{'html':publicacion.Contenido});
        var elemP2 = $('<p/>');
        alert(publicacion.Imagen);
        var elemA = $('<a/>',{'html':'Ver mas..', 'href':publicacion.Imagen});
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

$(document).ready(function ($) {
    'use strict';
    agregarPublicaciones();
});
