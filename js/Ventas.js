const fecha = new Date().toLocaleDateString();
document.getElementById("fecha").innerHTML = `Fecha: ${fecha}`;
//---------------------------------------------------------------------------------//
buscar_folio();
function buscar_folio() {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById("folio_venta").innerHTML = xhr.responseText;
            } else {
                console.log("Error: " + xhr.status);
            }
        }
    };


    xhr.open("POST", '../php/Consulta_no_folio_venta.php', true);
    xhr.send();
}
//----------------------------------------------------------------------------------//
buscar_empleado("");
function buscar_empleado(consulta = '') {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById("contenido_empleado").innerHTML = xhr.responseText;
            } else {
                console.log("Error: " + xhr.status);
            }
        }
    };

    var formData = new FormData();
    formData.append('consulta', consulta);

    xhr.open("POST", '../php/Empleado_consulta_venta.php', true);
    xhr.send(formData);
}

const miInput = document.getElementById('consulta_empleado');

miInput.addEventListener('input', function() {
    var valor = miInput.value;
    buscar_empleado(valor);
});