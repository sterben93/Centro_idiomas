$(document).ready(function (){
var lista='<div class="row">'+
           '<div class="col-xs-6 col-sm-9 col-md-9 col-lg-9">'+
           '<p>Inglés</p>'+
           '</div>'+
           '<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">'+
           '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalVermas">'+
           'Ver mas..'+
           '</button>'+
           '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEliminar">'+
           'Eliminar'+
           '</button>'+
           '</div>'+
           '</div>';
    $('#listaIdiomas').html(lista);
})
