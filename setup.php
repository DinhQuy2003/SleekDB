<?php

require_once __DIR__ . "/src/Store.php";

use SleekDB\Store;  
$replicaNodes = [
    "http://localhost:8002",
    "http://localhost:8003"
];

$shardNodes = [
    "http://localhost:8001",
    "http://localhost:8002",
    "http://localhost:8003"
];


$store = new Store("myDatabase", __DIR__ . "/data", $replicaNodes, $shardNodes);


$store->insert(["name" => "Alice", "age" => 25]);
$store->insert(["name" => "Bob", "age" => 30]);
$store->insert(["name" => "Charlie", "age" => 35]);
$store->insert(["name" => "David", "age" => 40]);
$store->insert(["name" => "Eve", "age" => 45]);
echo "Dữ liệu đã được thêm và gửi tới các node replica!";
?>
