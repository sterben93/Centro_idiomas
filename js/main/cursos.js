$(document).ready(function ($) {
    obtenerIdiomas();
    obtenerMaestros();
    obtenerNiveles();
});


function obtenerIdiomas() {
    var elemOption= $("<option/>",{'value':'0', 'html':'-- Seleccione un Idioma'});
    $("#select_Idiomas").append(elemOption);
    $.post("http://localhost/Backend/webServicesIdiomas.php",{'salida':"4"},function(resultado){
        var idiomas = JSON.parse(resultado);
        $.each(idiomas, function(index, idioma){
            elemOption= $("<option/>",{'value':idioma.idIdiomas+" "+idioma.Niveles, 'html':idioma.Idioma});
            $("#select_Idiomas").append(elemOption);
        });
    });
}

function obtenerMaestros() {
    var elemOption= $("<option/>",{'value':'0', 'html':'-- Seleccione un Docente'});
    $("#select_Docentes").append(elemOption);
    $.post("http://localhost/Backend/webServicesDocentes.php",{'salida':'4'},function(resultado){
        var docentes = JSON.parse(resultado);
        $.each(docentes, function(index, docente){
            elemOption= $("<option/>",{'value':docente.idDocente, 'html':docente.Nombre+" "+docente.Apellidos});
            $("#select_Docentes").append(elemOption);
        });
    });
}

function obtenerNiveles(){
    var elemOption= $("<option/>",{'value':'0', 'html':'-- Seleccione un Nivel'});
    $("#select_Niveles").append(elemOption);
    $("#select_Idiomas").change(function(){
        var nivel = this.value.split(" ");
        for(var i = 1; i<=nivel[1]; i++){
            $("#select_Niveles").append($("<option/>",{'value':i, 'html':i}));
        }
    })
}
