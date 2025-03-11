<?php
session_start();
require_once "../routes/db-connection.php";

header('Content-Type: application/json');

// Verifica se o usuário é admin
if (!isset($_SESSION['name']) || $_SESSION['user_role'] !== 'admin') {
    echo json_encode(["success" => false, "message" => "Acesso negado."]);
    exit;
}

// Verifica se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["success" => false, "message" => "Método inválido."]);
    exit;
}

// Pega os dados do formulário
$postId = $_POST['id'] ?? null;
$name = $_POST['name'] ?? null;
$address = $_POST['address'] ?? null;
$city = $_POST['city'] ?? null;
$state = $_POST['state'] ?? null;

if (!$postId || !$name || !$address || !$city || !$state) {
    echo json_encode(["success" => false, "message" => "Todos os campos são obrigatórios."]);
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE posts SET name = ?, address = ?, city = ?, state = ? WHERE id = ?");
    $stmt->execute([$name, $address, $city, $state, $postId]);

    echo json_encode(["success" => true, "message" => "Posto atualizado com sucesso!"]);
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Erro ao atualizar posto: " . $e->getMessage()]);
}
?>
