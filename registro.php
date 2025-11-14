<?php
include "conexion.php"; // Importa la conexión a la base de datos

$mensaje = ""; // Para mostrar errores o éxito

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del formulario
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $contrasena = trim($_POST["contrasena"]);

    // Validación básica
    if (empty($nombre) || empty($correo) || empty($contrasena)) {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo no tiene un formato válido.";
    } else {

        // Encriptar contraseña
        $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

        // Insertar en la base de datos
        $sql = "INSERT INTO usuarios (nombre, correo, contrasena)
                VALUES ('$nombre', '$correo', '$contrasena_hash')";

        if ($conexion->query($sql) === TRUE) {
            $mensaje = "Registro exitoso. Ahora puedes iniciar sesión.";
        } else {
            $mensaje = "Error: " . $conexion->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>

    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .container {
            width: 350px;
            margin: 80px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #0078ff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .mensaje {
            background: #eee;
            padding: 10px;
            text-align: center;
            margin-top: 10px;
            border-radius: 8px;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>Registro</h2>

    <form method="POST" action="">
        <input type="text" name="nombre" placeholder="Nombre completo">
        <input type="email" name="correo" placeholder="Correo electrónico">
        <input type="password" name="contrasena" placeholder="Contraseña">
        <button type="submit">Registrarme</button>
    </form>

    <?php if ($mensaje != ""): ?>
        <div class="mensaje">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
