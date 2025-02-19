<?php

$data = file_get_contents("php://input");
$jsonData = json_decode($data, true);

file_put_contents("replicate_log.txt", "Received Data: " . print_r($data, true) . "\n", FILE_APPEND);


if ($jsonData && is_array($jsonData)) {
    $fileName = uniqid() . ".json";
    $filePath = __DIR__ . "/data/" . $fileName;
    file_put_contents($filePath, json_encode($jsonData, JSON_PRETTY_PRINT));

    echo json_encode(["status" => "success", "message" => "Data replicated"]);
} else {
    echo json_encode(["status" => "error", "message" => "Invalid data received", "rawData" => $data]);
}
