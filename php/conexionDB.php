<?php

$servidor = "127.0.0.1";
$puerto = "3306";
$baseDatos = "sitio_aw";
$usuario = "root";
$contrasena = "";

try {
    $conexion = new PDO(
        "mysql:host=$servidor;port=$puerto;dbname=$baseDatos;charset=utf8mb4",
        $usuario,
        $contrasena,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );

} catch (PDOException $error) {
    http_response_code(500);
    exit("No se pudo conectar con la base de datos.");
}
