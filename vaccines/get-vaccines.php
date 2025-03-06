<?php
session_start();
require_once "../routes/db-connection.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, name FROM vaccines ORDER BY name ASC");
    $stmt->execute();
    $vaccines = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["success" => true, "data" => $vaccines]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erro ao buscar vacinas: " . $e->getMessage()]);
}
?>
