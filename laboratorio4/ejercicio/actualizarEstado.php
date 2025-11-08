<?php
include("conexion.php");
    $id = $_GET['id'];
    $estado = $_GET['estado'];

    $sql = "UPDATE citas SET estado=? WHERE id=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $estado, $id);
    if($stmt->execute()) {
        echo "Estado actualizado a $estado";
    } else {
        echo "Error al actualizar";
    }

?>
