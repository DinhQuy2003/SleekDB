<?php
require_once "src/Store.php";
use SleekDB\Store;  
$shardNodes = [
    "http://localhost:8001",
    "http://localhost:8002",
    "http://localhost:8003"
];

$store = new Store("myDatabase", __DIR__ . "/data", [], $shardNodes);

$names = ["Alice", "Bob", "Charlie", "David", "Eve"];

foreach ($names as $name) {
    $shardNode = $store->getShardNode($name);
    echo "Dữ liệu của $name sẽ được lưu trữ tại: " . $shardNode . "<br>";
}

?>