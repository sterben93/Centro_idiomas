$(document).ready(function ($) {
    $.post("http://localhost/Backend/webServicesIdiomas.php", {
        salida: 4
    }
        , function (resultado) {
            $idiomas = JSON.parse(resultado);
            $.each($idiomas, function (index, idioma) {
                var elemTr = $("<tr/>", {id:index});
                var elemTd = $("<td/>", { html: idioma.idIdiomas, id:"idIomas"+index});
                var elemTd2 = $("<td/>", { html: idioma.Idiomas, id:"Idiomas"+index});
                var elemTd3 = $("<td/>", { html: idioma.Niveles, id:"Niveles"+index});
                var elemTd4 = $("<td/>", { html: idioma.Objetivo, id:"Objetivo"+index});
                var elemTd5 = $("<td/>", { html: idioma.Perfil_Ingreso, id:"Perfil_Ingreso"+index});
                var elemTd6 = $("<td/>", { html: idioma.Perfil_Egreso, id:"Perfil_Egreso"+index});
                var elemTd7 = $("<td/>");
                var elemSpan = $('<span/>', { class: 'glyphicon glyphicon-edit' });
                var elemSpan2 = $('<span/>', { class: 'glyphicon glyphicon-remove' });
                var elemButton = $('<button/>', {
                    class: 'btn btn-default eliminar',
                    val: idioma.idIdiomas,
                    type: 'button',
                    'data-toggle': 'modal',
                    'data-target': '#modalEliminar'
                });
                var elemButton2 = $('<button/>', {
                    class: 'btn btn-default editar',
                    val: index,
                    type: 'button',
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
                elemTr.append(elemTd7);
                $('#listaIdiomas').append(elemTr);
            });
            $('#eliminar').click(function () {
                $.post("http://localhost/Backend/webServicesIdiomas.php", {
                    salida: 3
                    , idIdiomas: $cookie('id')
                }, function (resp) {
                    window.location.href = 'http://localhost/Centro_Idiomas/idiomas.html';
                    window.location.reload;
                })
            });
            $('.eliminar').click(function () {
                $cookie('id', this.value);
            });

            $('.editar').click(function () {
                var elemento = 'tr#'+this.value+' > td';
                var inputEdit= ["form#formUpdate > div > input#idIdiomas",
                                "form#formUpdate > div > input#idioma",
                                "form#formUpdate > div > #niveles",
                                "form#formUpdate > div > #objetivo", "form#formUpdate > div > #perfil_ingreso", "form#formUpdate > div > #prefil_egreso"];
                $(elemento).each(function (number, td){
                    if(number<6){
                        $(inputEdit[number]).val(td.innerHTML);
                    }

                });
            });
        });
});
