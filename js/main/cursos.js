$(document).ready(function ($) {
    obtenerIdiomas();
    obtenerMaestros();
    obtenerNiveles();
    agregarCursos();
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

function agregarCursos(){
    $.post("http://localhost/Backend/webServicesCursos.php", {salida: 2},
    function (resultado) {
        var cursos = JSON.parse(resultado);
        agregarElementos(cursos);
        $('#eliminar').click(function () {
        $.post("http://localhost/Backend/webServicesCursos.php", {
            salida: 4,
            idCursos: $cookie('id')
        }, function (resp) {
            $('.modal').modal('hide')
            $('#listaCursos').html("");
            agregarCursos();
        });
    });

    $('.eliminar').click(function () {
        $cookie('id', this.value);

    });
    }
    );
}

function agregarElementos(cursos) {
    $.each(cursos, function (index, curso) {
        var elemTr = $("<tr/>", {'id': index});
        var elemTd = $("<td/>", {'html': curso.idCursos});
        var elemTd2 = $("<td/>", {'html': curso.Nombre_del_Curso});
        var elemTd3 = $("<td/>", {'html': curso.Nivel});
        var elemTd4 = $("<td/>", {'html': curso.Horario});
        var elemTd5 = $("<td/>", {'html': curso.salon});
        var elemTd6 = $("<td/>", {'html': curso.Fec_Inicio_Insc});
        var elemTd7 = $("<td/>", {'html': curso.Fec_Fin_Insc});
        var elemTd8 = $("<td/>", {'html': curso.Fecha_Inicio_Curso});
        var elemTd9 = $("<td/>", {'html': curso.Fecha_Fin_Curso});
        var elemTd10 = $("<td/>", {'html': curso.Capacidad});
        var elemTd11 = $("<td/>", {'html': curso.Inscritos});
        var elemTd12 = $("<td/>");
        var elemSpan = $('<span/>', {'class': 'glyphicon glyphicon-remove'});

        var elemButton = $('<button/>', {
            'class': 'btn btn-default eliminar',
            'val': curso.idCursos,
            'type': 'button',
            'data-toggle': 'modal',
            'data-target': '#modalEliminar'
        });

        elemButton.append(elemSpan);

        elemTd12.append(elemButton);

        elemTr.append(elemTd);
        elemTr.append(elemTd2);
        elemTr.append(elemTd3);
        elemTr.append(elemTd4);
        elemTr.append(elemTd5);
        elemTr.append(elemTd6);
        elemTr.append(elemTd7);
        elemTr.append(elemTd8);
        elemTr.append(elemTd9);
        elemTr.append(elemTd10);
        elemTr.append(elemTd11);
        elemTr.append(elemTd12);
        $('#listaCursos').append(elemTr);
    });
}
