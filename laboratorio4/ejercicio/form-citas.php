<?php
include ("conexion.php");
$sqlMed = "SELECT id, nombre FROM medicos";
$resMed = $con->query($sqlMed);
$sqlPac = "SELECT id, nombre FROM pacientes";
$resPac = $con->query($sqlPac);
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar Cita</title>
</head>
<body>

  <h3>Registrar cita</h3>

  <form action="javascript:crearCita()" method="post" id="form-cita">

    <label for="id_medico">Médico</label><br>
    <select name="medico" id="sel-medico" required>
      <?php while ($m = mysqli_fetch_assoc($resMed)) { ?>
        <option value="<?php echo $m['id']; ?>">
          <?php echo ($m['nombre']); ?></option>
      <?php } ?>
    </select>
    <br><br>

    <label for="id_paciente">Paciente</label><br>
    <select name="paciente" id="sel-paciente" required>
      <?php while ($p = mysqli_fetch_assoc($resPac)) { ?>
        <option value="<?php echo $p['id']; ?>">
          <?php echo ($p['nombre']); ?></option>
      <?php } ?>
    </select>
    <br><br>

    <label for="fecha">Fecha</label><br>
    <input type="date" name="fecha" id="fecha" >
    <br><br>

    <label for="hora">Hora</label><br>
    <input type="time" name="hora" id="hora" >
    <br><br>

    <label for="motivo">Motivo</label><br>
    <textarea name="motivo" id="motivo" rows="3" cols="40"></textarea>
    <br><br>
    <input type="submit" value="Registrar cita">
  </form>

</body>
</html>