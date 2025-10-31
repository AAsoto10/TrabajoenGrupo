<?php 
include("conexion.php");
$n=$_POST['numero'];
$sql="SELECT * FROM carreras";
$stmt=$con->prepare($sql);
$stmt->execute();
$resultado=$stmt->get_result();

$carreras = [];
while ($row = mysqli_fetch_array($resultado)) {
    $carreras[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css" />
    <style>
        .inputs{
            border: 3px solid black;
            padding: 10px;
            border-radius: 5px;
            
        }
        select {
            border: 3px solid black;
            padding: 10px;
            border-radius: 5px;
        }
        .btn{    
            width: 100px;
            padding: 10px;
            background-color: #edece9ff;
            border-radius: 5px;
            margin: 10px;
            border: none;
            font-weight: bold;}
        .btn:hover{
            border: 5px solid red
        }
        .radio {
             transform: scale(1.6);
             margin-right: 8px;
        }

    </style>
</head>
<body>
    <form action="insertar.php" method="post" enctype="multipart/form-data">
        <div class="contenedor">
            <table class="tabla">
            <tr>
                <th></th>
                <th>fotografia</th>
                <th>nombres</th>
                <th>apellidos</th>
                <th>CU</th>
                <th>sexo</th>
                <th>carrera</th>
                
            </tr>
            <?php for($i=0;$i<$n;$i++){ ?>
            <tr>
                <td><?php echo $i+1 ?></td>
                 <td>
                    <label class="label">Seleccionar
                        <input class="foto" type="file" name="fotografia[]">
                    </label>
                </td>
                <td><input class="inputs" type="text" name="nombres[]" ></td>
                <td><input class="inputs" type="text" name="apellidos[]" ></td>
                <td><input class="inputs" type="text" name="cu[]" ></td>
                <td> 
                    <input class="inputs radio" type="radio" name="sexo[<?php echo $i ?>]"  value="M">Masculino
                    <input class="inputs radio" type="radio" name="sexo[<?php echo $i ?>]"  value="F">Femenino
                </td>
                <td>
                    <select name="carrera[]">
                        <?php foreach ($carreras as $row) { ?>
                        <option value="<?php echo $row["id"];?>">
                            <?php echo $row["carrera"];?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <input type="submit" value="Ingresar" class="btn">
        <button class="btn" type="reset">Borrar</button>
        </div>
    </form>
</body>
</html>