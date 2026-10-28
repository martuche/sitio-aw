<?php

$rutaEntorno = dirname(__DIR__) . '/.env';

if (!is_file($rutaEntorno)) {
    http_response_code(500);
    exit('Falta la configuración de la base de datos.');
}

$configuracion = parse_ini_file($rutaEntorno, false, INI_SCANNER_RAW);

if ($configuracion === false) {
    http_response_code(500);
    exit('No se pudo leer la configuración.');
}

$servidor = $configuracion['DB_HOST'] ?? '127.0.0.1';
$puerto = $configuracion['DB_PORT'] ?? '3306';
$baseDatos = $configuracion['DB_NAME'] ?? 'sitio_aw';
$usuario = $configuracion['DB_USER'] ?? '';
$contrasena = $configuracion['DB_PASSWORD'] ?? '';

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
