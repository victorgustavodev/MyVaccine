<?php

require_once "../routes/db-connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $state = $_POST["state"];

    if ($name && $address && $city && $state) {
        $stmt = $pdo->prepare("INSERT INTO posts (name, address, city, state) VALUES (?, ?, ?, ?)");
        $success = $stmt->execute([$name, $address, $city, $state]);

        echo json_encode(["success" => $success]);
    } else {
        echo json_encode(["success" => false]);
    }
}
?>