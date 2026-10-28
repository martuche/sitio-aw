<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    exit("Método no permitido.");
}

$nombre = trim($_POST["nombre"] ?? "");
$apellido = trim($_POST["apellido"] ?? "");
$mail = trim($_POST["mail"] ?? "");
$mensaje = trim($_POST["mensaje"] ?? "");

if (
    $nombre === "" ||
    $apellido === "" ||
    $mensaje === "" ||
    !filter_var($mail, FILTER_VALIDATE_EMAIL) ||
    mb_strlen($nombre) > 100 ||
    mb_strlen($apellido) > 100 ||
    strlen($mail) > 200 ||
    mb_strlen($mensaje) > 1000
) {
    http_response_code(400);
    exit("Los datos ingresados no son válidos.");
}

require_once dirname(__DIR__, 2) . '/php/conexionDB.php';

try {
    $consulta = $conexion->prepare(
        "INSERT INTO mensajes
         (nombre, apellido, mail, mensaje)
         VALUES
         (:nombre, :apellido, :mail, :mensaje)"
    );

    $consulta->execute([
        ":nombre" => $nombre,
        ":apellido" => $apellido,
        ":mail" => $mail,
        ":mensaje" => $mensaje
    ]);

} catch (PDOException $error) {
    http_response_code(500);
    exit("No se pudo guardar el mensaje.");
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mensaje enviado</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <section class="seccion fondo-celeste-claro">
        <h1 class="texto-azul-oscuro">
            El mensaje fue enviado exitosamente.
        </h1>

        <p>Gracias por contactarme. En breve recibirá una respuesta.</p>

        <a href="../index.html">Volver al inicio</a>
    </section>
</body>
</html>
