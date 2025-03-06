<?php
require_once '../routes/db-connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $min_age = $_POST['min_age'];
    $max_age = $_POST['max_age'];
    $contraindications = $_POST['contraindications'];

    $stmt = $pdo->prepare("INSERT INTO vaccines (name, min_age, max_age, contraindications) VALUES (?, ?, ?, ?)");
    $result = $stmt->execute([$name, $min_age, $max_age, $validate, $contraindications]);

    echo json_encode(["success" => $result]);
    exit();
}
?>