/* global $ */
var mensajes = {
    user: "Su usuario esta escrito incorrectamente por favor verificarlo"
    , password: "Su contraseña esta escrito incorrectamente"
    , nombre: "Tu nombre no esta bien escrito"
    , apellido: "Tu apellido no esta bien escrito"
    , correo: "Verifique que su correo este bien escrito"
    , contraseña: "Su contraseña debe de iniciar con mayuscula y tines un rango de 8 a 16 caracteres"
};

var errores = {
    'registro': 'Usuario registrado, espera que un administrador te de de alta en la aplicacion.'
    , 'errorRegistro': 'Error de conexion'
    , 'email': 'Su contraseña a sido enviado a tu correo'
    , 'errorEmail': 'error de conexion'
    , 'erroLogin': 'Contraseña o Usuario son incorrectos'
};

var patron = {
    user: /CI[A-Z]{3}[A-Z|0-9]{3}/
    , password: /[A-Z][A-Z-a-z|0-9]{8,15}/
    , nombre: /([A-Z]([a-zA-Z ñáéíóúÑ])+)([\s]|([A-Z]([a-zA-Z ñáéíóúÑ]+)))*/
    , apellidos: /([A-Z]([a-zA-Z ñáéíóúÑ])+)([\s]|([A-Z]([a-zA-Z ñáéíóúÑ]+)))+/
    , correo: /^([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}$/
    , contraseña : /[A-Z][A-Z-a-z|0-9]{8,15}/
};

/**
 *
 * @param {type} formulario
 * @returns {undefined}
 */
function mensajeAyuda(formulario) {
    $(formulario).progression({
        tooltipWidth: '200'
        , tooltipPosition: 'right'
        , tooltipOffset: '50'
        , showProgressBar: true
        , showHelper: true
        , tooltipFontSize: '14'
        , tooltipFontColor: 'fff'
        , progressBarBackground: 'fff'
        , progressBarColor: '6EA5E1'
        , tooltipBackgroundColor: '222'
        , tooltipPadding: '10'
        , tooltipAnimate: true
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

function verificaInput () {
    $('input').each(function (num, elem) {
        if (!validarCampo(elem.name + "", elem.value)) {
            alert(mensajes[elem.name]);
            return false;
        } else {
            return true;
        }
    });
}

function cambioInput() {
    if (this.value != "") {
        if (!validarCampo(this.name + "", this.value)) {
            alert(mensajes[this.name]);
        }
    }
}
