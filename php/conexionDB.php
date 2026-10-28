<?php

$rutaEntorno = dirname(__DIR__) . '/.env';

if (!is_file($rutaEntorno)) {
    http_response_code(500);
    exit("No se encontró la configuración de la base de datos.");
}

$configuracion = parse_ini_file($rutaEntorno, false, INI_SCANNER_RAW);

if ($configuracion === false) {
    http_response_code(500);
    exit("No se pudo leer la configuración de la base de datos.");
}

$servidor = $configuracion['DB_HOST'];
$puerto = $configuracion['DB_PORT'];
$baseDatos = $configuracion['DB_NAME'];
$usuario = $configuracion['DB_USER'];
$contrasena = $configuracion['DB_PASSWORD'];

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
    error_log("Error de conexión MySQL: " . $error->getMessage());

    http_response_code(500);
    exit("No se pudo conectar con la base de datos.");
}
