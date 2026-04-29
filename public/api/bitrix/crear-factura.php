<?php

header('Content-Type: application/json');

$raw = file_get_contents("php://input");
$get = $_GET;
$post = $_POST;
$headers = getallheaders();

file_put_contents(
    $_SERVER['DOCUMENT_ROOT'] . "/IntegracionOpenPay/public/storage/logs/bitrix_debug.log",
    date("c") . PHP_EOL .
    "RAW: " . $raw . PHP_EOL .
    "GET: " . json_encode($get) . PHP_EOL .
    "POST: " . json_encode($post) . PHP_EOL .
    "HEADERS: " . json_encode($headers) . PHP_EOL .
    "------------------------" . PHP_EOL,
    FILE_APPEND
);

echo json_encode([
    "ok" => true,
    "raw" => $raw,
    "get" => $get,
    "post" => $post
]);