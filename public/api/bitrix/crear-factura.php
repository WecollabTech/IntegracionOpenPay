<?php

header('Content-Type: application/json; charset=utf-8');

// ======================
// VALIDAR TOKEN
// ======================
$token = $_GET['token'] ?? '';

if ($token !== 'rm1xmm2go27f7jfw3ebactgkc8sjxnow') {
    http_response_code(403);
    exit('INVALID TOKEN');
}

// ======================
// RECIBIR DATOS BITRIX
// ======================
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// ======================
// RUTA DEL LOG
// ======================
$logFile = $_SERVER['DOCUMENT_ROOT'] . "/IntegracionOpenPay/public/storage/logs/bitrix.log";

// ======================
// CREAR LOG
// ======================
file_put_contents(
    $logFile,
    date("c") . " | " . $raw . PHP_EOL,
    FILE_APPEND
);

// ======================
// RESPUESTA
// ======================
echo json_encode([
    "ok" => true,
    "message" => "Webhook recibido",
    "data" => $data
]);