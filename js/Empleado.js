function buscar(consulta) {
    $.ajax({
        url:'../php/Empleado_consulta.php',
        type: 'POST',
        dataType:'html',
        data:{consulta:consulta},
    })
    .done(function(respuesta){
        $("#contenido").html(respuesta);
    })
    .fail(function(){
        console.log("error");
    });
}