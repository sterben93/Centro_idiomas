$(document).ready(function () {
    var formulario = "#formLogin";
    mensajeAyuda(formulario);
    var urlActual = window.location.toString().split("=");
    if (urlActual[1] == 0) {
        $("#mensaje").html("Usuario o Contraseña Incorrecta o tu usuario no a sido dado de alta");
    } else {
        $("#mensaje").html("");
    }

    if (urlActual[1] == 'ok') {
        alert("Tu usuario a sido enviado a tu correo");
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

