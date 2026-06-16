<?php
// --- CONFIGURACIÓN FORMSPREE ---
$formspree_url = "https://formspree.io/f/xgvywzbq";

// --- CAPTURA DE DATOS ---
$nombre   = $_POST['nombre']   ?? '';
$email    = $_POST['email']    ?? '';
$telefono = $_POST['telefono'] ?? '';
$servicio = $_POST['servicio'] ?? '';
$fecha    = $_POST['fecha_evento'] ?? '';
$ciudad   = $_POST['ciudad']   ?? '';
$mensaje  = $_POST['mensaje']  ?? '';

// --- VALIDACIÓN ---
if (empty($email)) {
    header('Location: https://laserman.com.ar/#contacto');
    exit;
}

// --- ENVIAR A FORMSPREE ---
$data = array(
    'nombre' => $nombre,
    'email' => $email,
    'telefono' => $telefono,
    'servicio' => $servicio,
    'fecha_evento' => $fecha,
    'ciudad' => $ciudad,
    'mensaje' => $mensaje,
    '_subject' => 'Nuevo Lead desde Laserman.com.ar - ' . $servicio
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/json\r\n",
        'method'  => 'POST',
        'content' => json_encode($data)
    )
);

$context = stream_context_create($options);
$result = @file_get_contents($formspree_url, false, $context);

// Redirigir a /gracias siempre (los datos ya se enviaron)
header('Location: https://laserman.com.ar/gracias');
exit;