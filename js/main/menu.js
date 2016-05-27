$(document).ready(function ($) {
    'use strict';
    if ($cookie("nombre") === undefined) {
        var urlActual = window.location.toString().split("#/");
        alert(urlActual[1]);
        $cookie("nombre", urlActual[1]);
        $.post("http://localhost/Backend/webServicesAdministrador.php", { salida: 5, user: $cookie("nombre") }, function (resp) {
            $("#nombreUser").html(resp);
        });
    } else {
        $.post("http://localhost/Backend/webServicesAdministrador.php", { salida: 5, user: $cookie("nombre") }, function (resp) {
            $("#nombreUser").html(resp);
        });
    }
    $("#cerrar").click(function () {
        $removeCookie("nombre");
    });
});
