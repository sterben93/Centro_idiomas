$(document).ready(function ($) {
    cargar();
});
function cargar() {
    $.post("http://localhost/Backend/webServicesInscripcion.php", { salida: 2 }, function (resp) {
        var inscritos = JSON.parse(resp);
        agreagrInscritos(inscritos);
        cargarComp();
    })
}
function agreagrInscritos(inscritos) {
    $.each(inscritos, function (index, ins) {
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
            'html': ins.Nombre + " " + ins.Apellido_Paterno + " " + ins.Apellido_Materno
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
        var elemTd7 = $("<td/>", {
            'html': status(ins.Status)
        });

        var elemTd8 = $("<td/>");
        if (ins.Status == "0") {
            var elemSpan = $('<span/>', {
                'class': 'glyphicon glyphicon-ok'
            });

            var elemSpan2 = $('<span/>', {
                'class': 'glyphicon glyphicon-remove'
            });

            var elemButton = $('<button/>', {
                'class': 'btn btn-default insc'
                , 'val': ins.idInscripciones
                , 'type': 'button'
                , 'data-toggle': 'modal'
                , 'data-target': '#modalIns'
            });
            var elemButton2 = $('<button/>', {
                'class': 'btn btn-default eliminar'
                , 'val': ins.idInscripciones
                , 'type': 'button'
                , 'data-toggle': 'modal'
                , 'data-target': '#modalEliminar'
            });
            elemButton.append(elemSpan);
            elemButton2.append(elemSpan2);
            elemTd8.append(elemButton);
            elemTd8.append(elemButton2);
        }

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


        elemTr.append(elemTd);
        elemTr.append(elemTd2);
        elemTr.append(elemTd3);
        elemTr.append(elemTd4);
        elemTr.append(elemTd5);
        elemTr.append(elemTd6);
        elemTr.append(elemTd7);
        elemTr.append(elemTd8);
        $("#listaIncriptos").append(elemTr);

    })
}

function cargarComp() {
    $('#eliminar').click(function () {
        $.post("http://localhost/Backend/webServicesInscripcion.php", {
            salida: 3,
            idInscripciones: $cookie('id')
        }, function (resp) {
            $("#listaIncriptos").html("");
            cargar();
            $('.modal').modal('hide')
        });
    });
    $('.eliminar').click(function () {
        $cookie('id', this.value);
    });
    $('.insc').click(function(){
        $.post("http://localhost/Backend/webServicesInscripcion.php", {
            salida: 4,
            idInscripciones: this.value
        }, function (resp) {
            $("#listaIncriptos").html("");
            cargar();
            $('.modal').modal('hide')
        });
    })
}
function status(st) {
    if (st == "0") {
        return "Pendiente";
    } else {
        return 'Aceptado'
    }
}
