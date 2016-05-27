$(document).ready(function($){
    $.post("http://localhost/Backend/webServicesInscripcion.php", {salida:2},function(resp){
        var inscritos = JSON.parse(resp);
        agreagrInscritos(inscritos);
    })
});

function agreagrInscritos(inscritos){
    $.each(inscritos, function(index, ins){
      var elemTr = $("<tr/>", {
            'id': index
        });
        var elemTd = $("<td/>", {
            'html': ins.Fecha_Insc
        });
        var elemTd2 = $("<td/>", {
            'html': ins.N_Control
        });
        var elemTd3 = $("<td/>", {
            'html': ins.Nombre+" "+ins.Apellido_Paterno+" "+ins.Apellido_Materno
        });
        var elemTd4 = $("<td/>", {
            'html': ins.Carrera
        });
        var elemTd5 = $("<td/>", {
            'html': ins.Semestre
        });
        var elemTd6 = $("<td/>", {
            'html': ins.Cursos_idCursos
        });

        var elemTd7 = $("<td/>");
        var elemSpan = $('<span/>', {
            'class': 'glyphicon glyphicon-ok'
        });

        var elemButton = $('<button/>', {
            'class': 'btn btn-default insc'
            , 'val': ins.idInscripciones
            , 'type': 'button'
            , 'data-toggle': 'modal'
            , 'data-target': '#modalIns'
        });

        elemButton.append(elemSpan);
        elemTd7.append(elemButton);
        elemTr.append(elemTd);
        elemTr.append(elemTd2);
        elemTr.append(elemTd3);
        elemTr.append(elemTd4);
        elemTr.append(elemTd5);
        elemTr.append(elemTd6);
        elemTr.append(elemTd7);
        $("#listaIncriptos").append(elemTr);

    })
}
