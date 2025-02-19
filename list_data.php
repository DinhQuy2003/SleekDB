<?php
$files = glob(__DIR__ . "/data/*.json");
header("Content-Type: application/json");
echo json_encode(["files" => $files], JSON_PRETTY_PRINT);
?>
