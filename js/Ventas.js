let isVisible = false;
toggleDiv();
function toggleDiv(isVisible) {
  document.getElementById("lo_de_Juegos").style.display = isVisible ? "block" : "none";
}
const fecha = new Date().toLocaleDateString();
document.getElementById("fecha").innerHTML = `Fecha: ${fecha}`;
//---------------------------------------------------------------------------------//
select_empleado();
function select_empleado() {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById("select_empleado").innerHTML = xhr.responseText;
                const empleado = document.getElementById('ids_empleados');
                empleado.addEventListener("change", function() {
                    const nss = empleado.value;
                    if (nss != "Selecciona un empleado") {
                        toggleDiv(isVisible = true);
                    }
                    else {
                        toggleDiv(isVisible = false); 
                    }
                    buscar_empleado(nss);
                });
            } else {
                console.log("Error: " + xhr.status);
            }
        }
    };


    xhr.open("POST", '../php/Empleado_nombre.php', true);
    xhr.send();
}

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
function buscar_empleado(consulta) {
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
//-----------------------------------------------------------------------------//

function buscar_juego(idJuego) {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                document.getElementById("contenido_juego").innerHTML = xhr.responseText;
            } else {
                console.log("Error: " + xhr.status);
            }
        }
    };

    var formData = new FormData();
    formData.append('idJuego', idJuego);

    xhr.open("POST", '../php/Juego_consulta_venta.php', true);
    xhr.send(formData);
}

const id_juego = document.getElementById('idJuego');

id_juego.addEventListener('input', function() {
    var valor = id_juego.value;
    buscar_juego(valor);
});
//------------------------------------------------------------------//


