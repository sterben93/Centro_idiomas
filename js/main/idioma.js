$(document).ready(function ($) {
    var urlActual = window.location.toString();
    var id = urlActual.split("#/");
    $.post("http://localhost/Backend/webServicesIdiomas.php", {
        'salida': 5
        , idIdiomas: id[1]
    }, function (idioma) {
        idioma = JSON.parse(idioma);
        $("#imagen").attr("src", "http://localhost/Backend/" + idioma.Imagen);
        $("#idioma").html(idioma.Idioma);

        crearParrafos($("#objetivo"), idioma.Objetivo.split("\n"));
        var lista = idioma.Perfil_Ingreso.split("\n");
        crearLista($("#Perfil_Ingreso"), lista);
        crearLista($("#Perfil_Egreso"), idioma.Perfil_Egreso.split("\n"));
    });
    $.post("http://localhost/Backend/webServicesCursos.php", {
        salida: 3
        , idIdiomas: id[1]
    }
        , function (resultado) {
            var cursos = JSON.parse(resultado);
            agregarElementos(cursos);
        }
    );
    $('input').change(cambioInput);

    $('#bt_Solicitud').click(verificaInput);
});

function crearLista(elem, lista) {
    $.each(lista, function (index, list) {
        elem.append($("<li/>", {
            'html': list
        }));
    })
}

function crearParrafos(elem, lista) {
    $.each(lista, function (index, list) {
        elem.append($("<p/>", {
            'html': list
        }));
    })
}

function agregarElementos(cursos) {
    $.each(cursos, function (index, curso) {
        var elemTr = $("<tr/>", {
            'id': index
        });

        var elemTd2 = $("<td/>", {
            'html': curso.Nombre_del_Curso
        });
        var elemTd3 = $("<td/>", {
            'html': curso.Nivel
        });
        var elemTd4 = $("<td/>", {
            'html': curso.Horario
        });
        var elemTd5 = $("<td/>", {
            'html': curso.salon
        });
        var elemTd8 = $("<td/>", {
            'html': curso.Fecha_Inicio_Curso
        });
        var elemTd9 = $("<td/>", {
            'html': curso.Fecha_Fin_Curso
        });

        var fecha = curso.Fec_Inicio_Insc;
        var fecha2 = curso.Fec_Fin_Insc;
        alert(fecha+" "+fecha2)
        var hoy = new Date();
        var array_fecha = fecha.split("-");
        var dia = array_fecha[2];
        var mes = (array_fecha[1] - 1);
        var ano = (array_fecha[0]);
        alert(dia+" "+mes+" "+ano)
        var fechaDate = new Date(ano, mes, dia);
        array_fecha2 = fecha2.split("-");
        dia = array_fecha2[2];
        mes = (array_fecha2[1] - 1);
        ano = (array_fecha2[0]);
        var fechaDate2 = new Date(ano, mes, dia);
        var elemTd12 = $("<td/>");
        if(fechaDate<hoy && fechaDate2>hoy){
            var elemSpan = $('<span/>', {
            'class': 'glyphicon glyphicon-edit'
        });
        var elemButton = $('<button/>', {
            'class': 'btn btn-default insc'
            , 'val': curso.idCursos
            , 'type': 'button'
            , 'data-toggle': 'modal'
            , 'data-target': '#modalIns'
        });
        elemButton.append(elemSpan);
        elemButton.html(elemButton.html()+" Inscripción");
        elemTd12.append(elemButton);
        }else{
           elemTd12.html("Inscripciones al curso finalizadas");
        }

        elemTr.append(elemTd2);
        elemTr.append(elemTd3);
        elemTr.append(elemTd4);
        elemTr.append(elemTd5);
        elemTr.append(elemTd8);
        elemTr.append(elemTd9);
        elemTr.append(elemTd12);
        $('#listaCursos').append(elemTr);
        $('.insc').click(function () {
            $("#Cursos").val(this.value);
        });
    });
}
