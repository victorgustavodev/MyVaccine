<?php
session_start();
require_once "../routes/db-connection.php";

header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}

if (!isset($_GET['id'])) {
    echo json_encode(["success" => false, "message" => "ID do posto não informado."]);
    exit;
}
 
$postId = $_GET['id'];

try {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
    $stmt->execute([$postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($post) {
        echo json_encode(["success" => true, "data" => $post]);
    } else {
        echo json_encode(["success" => false, "message" => "Posto não encontrado."]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erro ao buscar posto: " . $e->getMessage()]);
}
?>
