/* global $ */
var mensajes = {
    idAdministrador: "Su usuario esta escrito incorrectamente por favor verificarlo."
    , Nombre: "Tu nombre no esta bien escrito."
    , Apellidos: "Tus apellidos no esta bien escrito"
    , Correo: "Verifique que su correo este bien escrito."
    , Contraseña: "Su contraseña debe de iniciar con mayúscula y de una longitud de 8 a 16 caracteres."
};

var errores = {
    'registro': 'Usuario registrado, espera que un administrador te de alta en la aplicación.'
    , 'errorRegistro': 'Error de conexión.'
    , 'email': 'Su contraseña a sido enviado a tu correo.'
    , 'errorEmail': 'Error de conexión.'
    , 'erroLogin': 'Contraseña o Usuario son incorrectos.'
};

var patron = {
    idAdministrador: /CI[A-Z]{3}[A-Z|0-9]{3}/
    , password: /[A-Z][A-Z-a-z|0-9]{8,15}/
    , Nombre: /([A-Z]([a-zA-Z ñáéíóúÑ])+)([\s]|([A-Z]([a-zA-Z ñáéíóúÑ]+)))*/
    , Apellidos: /([A-Z]([a-zA-Z ñáéíóúÑ])+)([\s]|([A-Z]([a-zA-Z ñáéíóúÑ]+)))+/
    , Correo: /^([\w\.\-_]+)?\w+@[\w-_]+(\.\w+){1,}$/
    , Contraseña: /[A-Z][A-Z-a-z|0-9]{8,15}/
};

url_Backend="http://localhost/Backend/"
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

function verificaInput() {
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
