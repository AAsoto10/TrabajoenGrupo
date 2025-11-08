function cargarContenido(abrir) {

    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("get", abrir, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
        }
    }
    ajax.setRequestHeader("Content-Type", "text/html; charset=utf-8");
    ajax.send();
    
}

function crear()
{
    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    var datos=new FormData(document.querySelector('#form-insertar'));
    ajax.open("post", "create.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
            
            setTimeout(function(){
                cargarContenido('read-paci.php');
            }, 5000);
            
        }
    }
    ajax.send(datos);
}

function create()
{
    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    var datos=new FormData(document.querySelector('#insertar'));
    ajax.open("post", "create-paciente.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
            
            setTimeout(function(){
                cargarContenido('read-paci.php');
            }, 5000);
            
        }
    }
    ajax.send(datos);
}

function crearCita(){
    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    var datos=new FormData(document.querySelector('#form-cita'));
    ajax.open("post", "create-cita.php", true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
            
            setTimeout(function(){
                cargarContenido('read-citas.php');
            }, 5000);
            
        }
    }
    ajax.send(datos);
}



function formEditar(id) {
    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("GET", `formeditar.php?id=${id}`, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
        }
    }
    ajax.send();

}
function formEditarPaciente(id) {
    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    ajax.open("GET", `formeditar-paciente.php?id=${id}`, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
        }
    }
    ajax.send();

}

function editar()
{
    var ajax = new XMLHttpRequest();
    var datos=new FormData(document.querySelector('#form-editar'));
    ajax.open("POST", "edit.php", true)
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
            setTimeout(function(){
                cargarContenido('read.php');
            }, 5000);
            
        }
    }
    ajax.send(datos);
}
function editarPaciente()
{
    var ajax = new XMLHttpRequest();
    var datos=new FormData(document.querySelector('#form-editare'));
    ajax.open("POST", "editar-paciente.php", true)
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
            setTimeout(function(){
                cargarContenido('read-paci.php');
            }, 5000);
            
        }
    }
    ajax.send(datos);
}


function eliminar(id) { 
    if (confirm("Estas seguro que quieres eliminar")) {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", `delete.php?id=${id}`, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                document.querySelector('#contenido').innerHTML = ajax.responseText;
            }
            setTimeout(function(){
                cargarContenido('read.php');
            }, 5000);
        }
        ajax.send();
    
    }
}

function eliminarPaciente(id) { 
    if (confirm("Estas seguro que quieres eliminar")) {
        var ajax = new XMLHttpRequest();
        ajax.open("GET", `delete-paciente.php?id=${id}`, true);
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4 && ajax.status == 200) {
                document.querySelector('#contenido').innerHTML = ajax.responseText;
            }
            setTimeout(function(){
                cargarContenido('read-paci.php');
            }, 5000);
        }
        ajax.send();
    
    }
}

function buscarCitas() {
  const q = document.getElementById('buscar').value;
  const url = 'read-citas.php?ajax=1&buscar=' + q;
  const tabla = document.getElementById('tabla-citas');
  fetch(url)
    .then(res => res.text())
    .then(html => tabla.innerHTML = html)
    .catch(err => tabla.innerHTML = 'Error al buscar');
}


function cambiarEstado(id, estado) {
    if (confirm("Estas seguro que quieres cambiar el estado a " + estado + "?")) {

    var ajax = new XMLHttpRequest();
    ajax.open("GET", `actualizarEstado.php?id=${id}&estado=${estado}`, true);
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            document.querySelector('#contenido').innerHTML = ajax.responseText;
        }
        setTimeout(function(){
            cargarContenido('read-citas.php');
        }, 5000);
    }
    ajax.send();
    }
}
