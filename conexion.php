<?php
$host = "localhost";       // Servidor local
$usuario = "root";         // Usuario por defecto de XAMPP
$contrasena = "";          // Sin contraseña por defecto
$base_datos = "login_db";  // Nombre de la base creada

// Crear la conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar si hubo error
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Si llegaste aquí, la conexión fue exitosa
// Puedes dejar esta línea para pruebas (luego se borra):
// echo "Conexión exitosa!";
?>
