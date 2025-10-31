<?php include("conexion.php");

$sql="SELECT id,nombre,especialidad,telefono,correo FROM medicos";

$resultado=$con->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
         table {
            margin: 0 auto;
         }   
        th {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid black;
            background-color: #5c6bf3ff;
        }
        td{
            width: 200px;
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid black;
        }
        a {
            text-decoration: none;
            color: blue; 
        }
        
    </style>
</head>
<body>
    <table style="border-collapse: collapse" border="1" >
    <thead>
        <tr>
            <th width="100px">Nombres</th>
            <th width="100px">Especialidad</th>
            <th width="60px">Telefono</th>
            <th width="10px">Correo</th>
            <th>Operaciones</th>
        </tr>
    </thead>
    
 <?php 
 while($row=mysqli_fetch_array($resultado)){
    ?>
    <tr>
        <td><?php echo $row['nombre'];?></td>
        <td><?php echo $row['especialidad'];?></td>
        <td><?php echo $row['telefono'];?></td>
        <td><?php echo $row['correo'];?></td>
        <td>
            <a href="javascript:formEditar(<?php echo $row['id'];?>)">Editar</a>
            <a href="javascript:eliminar(<?php echo $row['id'];?>)">Eliminar</a> 
             <a href="javascript:cargarContenido('form-medico.html')"> Insertar</a>
        </td>
    </tr>
    <?php } ?>
 </table>
 
 
</body>
</html>
