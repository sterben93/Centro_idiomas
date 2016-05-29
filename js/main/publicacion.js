$(document).ready(function ($) {
    var urlInfo = window.location.toString().split('#/');
    $.post("http://localhost/Backend/webServicesPublicaciones.php", {
        opcion: 5
        , idPublicaciones: urlInfo[1]
    }
        , function (resultado) {
            var publicacion = JSON.parse(resultado);
            $("#imagenH").attr('src', publicacion.Imagen);
            $("#title").html(publicacion.Titulo);
            var parrafos = publicacion.Contenido.split("\n");
            $.each(parrafos, function (index, parrafo) {
                var elemP = $("<p/>", { 'html': parrafo });
                $("#contenido").append(elemP);
            })

        }
    );
});
