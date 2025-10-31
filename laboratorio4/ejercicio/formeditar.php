<?php include("conexion.php"); 
    $id=$_GET['id'];
    $sql="SELECT id,nombre,especialidad,telefono,correo FROM medicos WHERE id=$id";
    $resultado=$con->query($sql);
    $row = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="contenedorFormulario">
    <h2 class="titulo">Editar Médico</h2>
        <form action="javascript:editar()"method="post" id="form-editar">
        <label for="nombre">Nombre:</label>
        <input class="input" type="text" name="nombre" value="<?php echo $row['nombre'];?>">
        <br>
        <label for="especialidad">Especialidad:</label>
        <input class="input" type="text" name="especialidad" value="<?php echo $row['especialidad'];?>">
        <br>
        <label for="telefono">Telefono:</label>
        <input class="input" type="text" name="telefono" value="<?php echo $row['telefono'];?>">
        <br>
        <label for="correo">Correo:</label>
        <input class="input" type="email" name="correo" value="<?php echo $row['correo'];?>">
        <br>
        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <input class="boton" type="submit" value="Actualizar">

    </form>
    
    </div>

</body>
</html>