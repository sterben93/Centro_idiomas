/* global $ */
var patron = {user: /CI[A-Z]{3}[A-Z|0-9]{3}/,
    password: /[A-Z][A-Z-a-z|0-9]{8,16}/,
    nombre: /([A-Z][a-z][ ])*[A-Z][a-z]/,
    apellido: /[A-Z][a-z][ ][A-Z][a-z]/,
    email: / /};

var mensajes = {user: "Su usuario esta escrito incorrectamente por favor verificarlo",
    password: "Su contraseña esta escrito incorrectamente",
    nombre: "",
    apellido: "",
    email: ""};

/**
 *
 * @param {type} formulario
 * @returns {undefined}
 */
function  mensajeAyuda(formulario) {
    $(formulario).progression({
        tooltipWidth: '200',
        tooltipPosition: 'right',
        tooltipOffset: '50',
        showProgressBar: true,
        showHelper: true,
        tooltipFontSize: '14',
        tooltipFontColor: 'fff',
        progressBarBackground: 'fff',
        progressBarColor: '6EA5E1',
        tooltipBackgroundColor: '222',
        tooltipPadding: '10',
        tooltipAnimate: true
    });
}

/**
 *
 * @param {type} campo
 * @param {type} texto
 * @returns {undefined}
 */
function validarCampo(campo, texto) {
    var validarCampo = patron[campo].test(texto)
    return validarCampo;
}

function ajaxPHP(urlPHP, jsonData, funcion) {
    $.ajax({
        url: urlPHP,
        data: jsonData,
        type: 'POST',
        dataType: 'json',
        success: function (json) {
            funcion(json);
        },
        error: function (jqXHR, status, error) {
            alert('Disculpe, existió un problema ');
            ;
        },
        complete: function (jqXHR, status) {
            alert('Petición realizada');
        }
    });
}
