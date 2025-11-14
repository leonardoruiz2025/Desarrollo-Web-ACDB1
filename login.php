<?php
include "conexion.php";
session_start();

$mensaje = ""; // Para mostrar mensajes de error

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = trim($_POST["correo"]);
    $contrasena = trim($_POST["contrasena"]);

    // Validación básica
    if (empty($correo) || empty($contrasena)) {
        $mensaje = "Todos los campos son obligatorios.";
    } else {
        // Buscar al usuario por el correo
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo' LIMIT 1";
        $resultado = $conexion->query($sql);

        if ($resultado->num_rows > 0) {
            $usuario = $resultado->fetch_assoc();

            // Verificar contraseña
            if (password_verify($contrasena, $usuario["contrasena"])) {

                // Crear variables de sesión
                $_SESSION["usuario_id"] = $usuario["id"];
                $_SESSION["usuario_nombre"] = $usuario["nombre"];
                $_SESSION["usuario_correo"] = $usuario["correo"];

                // Redirigir a página protegida
                header("Location: bienvenido.php");
                exit();

            } else {
                $mensaje = "Contraseña incorrecta.";
            }

        } else {
            $mensaje = "El correo no está registrado.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>

    <style>
        body {
            font-family: Arial;
            background: #eee;
        }
        .container {
            width: 350px;
            margin: 80px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .mensaje {
            background: #ffd7d7;
            padding: 10px;
            margin-top: 10px;
            border-radius: 8px;
            color: #b31b1b;
            text-align: center;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>Iniciar Sesión</h2>

    <form method="POST" action="">
        <input type="email" name="correo" placeholder="Correo electrónico">
        <input type="password" name="contrasena" placeholder="Contraseña">
        <button type="submit">Entrar</button>
    </form>

    <?php if ($mensaje != ""): ?>
        <div class="mensaje">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
