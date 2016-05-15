var errores = {
    'registro': 'Usuario registrado, espera que un administrador te de de alta en la aplicacion.'
    , 'errorRegistro': 'Error de conexion'
    , 'email': 'Su contraseña a sido enviado a tu correo'
    , 'errorEmail': 'error de conexion'
    , 'erroLogin' : 'Contraseña o Usuario son incorrectos'

};

$(document).ready(function () {
    var formulario = "#formLogin";
    mensajeAyuda(formulario);
    var urlActual = window.location.toString();
    alert(urlActual.search("#"));
    if (urlActual.search('#') > 0) {
        urlActual = urlActual.split('#');
        alert(errores[urlActual[1]]);
    }

    $('input').change(function () {
        if (this.value != "") {
            if (!validarCampo(this.name + "", this.value)) {
                $("#mensaje").html(mensajes[this.name]);
            } else {
                $("#mensaje").html("");
            }
        }
    });

    $('#bt_Inicio').click(function () {
        $('input').each(function (num, elem) {
            if (!validarCampo(elem.name + "", elem.value)) {
                $("#mensaje").html(mensajes[elem.name]);
                return false;
            } else {
                $("#mensaje").html("");
                return true;
            }
        });
    });
});
