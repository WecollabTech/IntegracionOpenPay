<?php

header('Content-Type: application/json');

// 🔐 Validar token
$token = $_GET['token'] ?? null;
if ($token !== 'rm1xmm2go27f7jfw3ebactgkc8sjxnow') {
    http_response_code(403);
    echo json_encode(["error" => "Token inválido"]);
    exit;
}

// 📥 Obtener datos
$raw = file_get_contents("php://input");

// Intentar JSON
$data = json_decode($raw, true);

// Si no es JSON, parsear como form-data
if (!$data) {
    parse_str($raw, $data);
}

// 🔍 Extraer datos clave
$event = $data['event'] ?? null;
$itemId = $data['data']['FIELDS']['ID'] ?? null;
$entityTypeId = $data['data']['FIELDS']['ENTITY_TYPE_ID'] ?? null;

// 📝 Log mejorado
$logFile = __DIR__ . '/../../storage/logs/bitrix_debug.log';

file_put_contents(
    $logFile,
    date("c") . PHP_EOL .
    "EVENT: " . $event . PHP_EOL .
    "ITEM_ID: " . $itemId . PHP_EOL .
    "ENTITY_TYPE_ID: " . $entityTypeId . PHP_EOL .
    "RAW: " . $raw . PHP_EOL .
    "DECODED: " . json_encode($data) . PHP_EOL .
    "------------------------" . PHP_EOL,
    FILE_APPEND
);

// 🚨 Validar que sí haya datos útiles
if (!$event || !$itemId || !$entityTypeId) {
    echo json_encode([
        "ok" => false,
        "message" => "Datos incompletos"
    ]);
    exit;
}

// 🎯 Lógica por evento
switch ($event) {

    case 'ONCRMDYNAMICITEMADD':
        // Aquí lógica cuando se crea
        break;

    case 'ONCRMDYNAMICITEMUPDATE':
        // Aquí lógica cuando se actualiza
        break;

    default:
        // Evento no relevante
        break;
}

// ✅ Respuesta
echo json_encode([
    "ok" => true,
    "event" => $event,
    "itemId" => $itemId,
    "entityTypeId" => $entityTypeId
]);