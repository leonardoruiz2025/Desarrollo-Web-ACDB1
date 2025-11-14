<?php
session_start();

// Verificar si NO hay sesión activa
if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página protegida</title>

    <style>
        body {
            font-family: Arial;
            background: #e8f0fe;
        }
        .container {
            width: 400px;
            margin: 80px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 12px gray;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #d9534f;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 15px;
        }
    </style>

</head>
<body>

<div class="container">
    <h2>Bienvenido, <?php echo $_SESSION["usuario_nombre"]; ?> 🎉</h2>

    <p>Has iniciado sesión correctamente.</p>
    <p>Tu correo es: <strong><?php echo $_SESSION["usuario_correo"]; ?></strong></p>

    <a class="btn" href="logout.php">Cerrar sesión</a>
</div>

</body>
</html>
