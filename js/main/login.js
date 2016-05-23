$(document).ready(function () {
    var formulario = "#formLogin";
    mensajeAyuda(formulario);
    var urlActual = window.location.toString();
    if (urlActual.search('#') > 0) {
        urlActual = urlActual.split('#');
        alert(errores[urlActual[1]]);
    }
    $('input').change(cambioInput);

    $('#bt_Inicio').click(verificaInput);
});
