<?php

require_once "src/Store.php";
use SleekDB\Store;

header("Content-Type: application/json");

if (!isset($_GET['key'])) {
    echo json_encode(["status" => "error", "message" => "Thiếu tham số 'key'."]);
    exit;
}

$key = $_GET['key'];

$shardNodes = [
    "http://localhost:8001",
    "http://localhost:8002",
    "http://localhost:8003"
];

$store = new Store("myDatabase", __DIR__ . "/data", [], $shardNodes);
$expectedNode = $store->getShardNode($key);

if ($expectedNode !== "http://" . $_SERVER['HTTP_HOST']) {
    echo json_encode(["status" => "error", "message" => "Dữ liệu của $key không nằm trên node này. Vui lòng truy vấn tại: $expectedNode"]);
    exit;
}

$results = [];
$files = glob(__DIR__ . "/data/*.json");

foreach ($files as $file) {
    $data = json_decode(file_get_contents($file), true);
    if (isset($data['name']) && strtolower($data['name']) === strtolower($key)) {
        $results[] = $data;
    }
}

if (empty($results)) {
    echo json_encode(["status" => "error", "message" => "Không tìm thấy dữ liệu cho key: " . $key]);
} else {
    echo json_encode(["status" => "success", "data" => $results]);
}
?>
