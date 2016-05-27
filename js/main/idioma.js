$(document).ready(function($){
    var urlActual = window.location.toString();
    var id = urlActual.split("#/");
    $.post("http://localhost/Backend/webServicesIdiomas.php",{'salida':5, idIdiomas:id[1]},function(idioma){
        idioma=JSON.parse(idioma);
        $("#imagen").attr("src", "http://localhost/Backend/"+idioma.Imagen);
        $("#idioma").html(idioma.Idioma);

        crearParrafos($("#objetivo"),idioma.Objetivo.split("\n"));
        var lista = idioma.Perfil_Ingreso.split("\n");
        crearLista($("#Perfil_Ingreso"), lista);
        crearLista($("#Perfil_Egreso"),idioma.Perfil_Egreso.split("\n"));
    });
});

function crearLista(elem, lista){
    $.each(lista, function(index, list){
        elem.append($("<li/>",{'html':list}));
    })
}

function crearParrafos(elem, lista){
    $.each(lista, function(index, list){
        elem.append($("<p/>",{'html':list}));
    })
}
