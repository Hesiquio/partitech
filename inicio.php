<?php
// confirmar sesion
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="loggedin">
<nav class="navtop">
    <h1 style="color:white;">Sistema de PHP Básico</h1>
    <a href="perfil.php" style="color:white;"><i class="fas fa-user-circle"></i>Información de Usuario</a>
    <a href="cerrar-sesion.php" style="color:white;"><i class="fas fa-sign-out-alt"></i>Cerrar Sesión</a>
</nav>
<div class="content">
    <h2>Insertar Nuevo Estudiante</h2>
    <!-- Formulario para insertar datos en la tabla students con diseño Bootstrap -->
    <?php
    if (isset($_GET['mensaje'])) {
        echo "<p style='color: green;'>" . $_GET['mensaje'] . "</p>";
    }
    if (isset($_GET['error'])) {
        echo "<p style='color: red;'>" . $_GET['error'] . "</p>";
    }
    ?>
    <form method="POST" action="registro.php" class="form-horizontal">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nombres:</th>
                <th>Apellido Materno:</th>
                <th>Apellido Paterno:</th>
                <th>Grupo:</th>
                <th>Enviar</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input type="text" class="form-control" name="names" required></td>
                <td><input type="text" class="form-control" name="apellidomat" required></td>
                <td><input type="text" class="form-control" name="apellidopat" required></td>
                <td><input type="text" class="form-control" name="grupo" required></td>
                <td><input type="submit" class="btn btn-primary" value="Guardar"></td>
            </tr>
            </tbody>
        </table>
    </form>

    <!-- Mostrar la tabla de estudiantes -->
    <h3>Tabla de Estudiantes</h3>
    <?php
    // Aquí debes obtener y mostrar los datos de la tabla students
    // Conectar a la base de datos (incluye tu archivo de conexión)
    include 'conexionDB.php';

    // Consulta SQL para obtener todos los registros de students
    $sql = "SELECT * FROM students";
    $result = $con->query($sql);

    // Verificar si la tabla está vacía
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Nombres</th>";
        echo "<th>Apellido Materno</th>";
        echo "<th>Apellido Paterno</th>";
        echo "<th>Grupo</th>";
        echo "<th>Autor</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['nombres']}</td>";
            echo "<td>{$row['apellidomat']}</td>";
            echo "<td>{$row['apellidopat']}</td>";
            echo "<td>{$row['grupo']}</td>";
            echo "<td>{$row['autor']}</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No hay registros en la tabla de estudiantes.</p>";
    }

    // Cerrar la consulta
    $result->close();
    ?>
</div>
<!-- Incluye el archivo JavaScript de Bootstrap al final del cuerpo del documento -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
