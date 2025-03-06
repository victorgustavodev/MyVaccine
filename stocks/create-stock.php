<?php
require_once '../routes/db-connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $post_id = $_POST['post_id']; // ID do posto de vacinação
    $vaccine_id = $_POST['vaccine_id']; // ID da vacina
    $quantity = $_POST['quantity']; // Quantidade disponível
    $batch = $_POST['batch']; // Lote da vacina
    $expiration_date = $_POST['expiration_date']; // Data de validade

    // Validação básica dos dados (opcional)
    if (empty($post_id) || empty($vaccine_id) || empty($quantity) || empty($batch) || empty($expiration_date)) {
        echo json_encode(["success" => false, "message" => "Todos os campos são obrigatórios."]);
        exit();
    }

    // Prepara e executa a query de inserção
    $stmt = $pdo->prepare("INSERT INTO stocks (post_id, vaccine_id, quantity, batch, expiration_date) VALUES (?, ?, ?, ?, ?)");
    $result = $stmt->execute([$post_id, $vaccine_id, $quantity, $batch, $expiration_date]);

    // Retorna o resultado
    echo json_encode(["success" => $result]);
    exit();
}
?>