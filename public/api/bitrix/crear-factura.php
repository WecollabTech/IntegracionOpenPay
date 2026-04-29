<?php

header('Content-Type: application/json; charset=utf-8');

// =====================
// 1. VALIDAR TOKEN
// =====================
$token = $_GET['token'] ?? '';

if ($token !== 'rm1xmm2go27f7jfw3dsdsd') {
    http_response_code(403);
    echo json_encode(['ok' => false, 'error' => 'INVALID TOKEN']);
    exit;
}

// =====================
// 2. RECIBIR DATOS
// =====================
$raw = file_get_contents("php://input");

// =====================
// 3. GUARDAR LOG
// =====================
$logFile = __DIR__ . "/../../storage/logs/bitrix.log";

file_put_contents(
    $logFile,
    date("c") . " | " . $raw . PHP_EOL,
    FILE_APPEND
);

// =====================
// 4. RESPUESTA
// =====================
echo json_encode([
    'ok' => true,
    'message' => 'Datos recibidos correctamente',
    'received' => json_decode($raw, true)
]);