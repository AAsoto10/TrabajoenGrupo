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

function crearMedico()
{
    var ajax = new XMLHttpRequest(); //crea el objeto ajax
    var datos=new FormData(document.querySelector('#form-insertar'));
    ajax.open("post", "create.php", true);
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

function crearPaciente()
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
