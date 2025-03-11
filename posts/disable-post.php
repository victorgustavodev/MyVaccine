<?php 
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-adm.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara a consulta SQL para desativar o posto
    $stmt = $pdo->prepare("UPDATE posts SET status = 'inativo' WHERE id = ?");
    $stmt->execute([$id]);

    // Redireciona para a página de listagem ou exibe uma mensagem
    header("Location: ./read-post.php"); // Supondo que posts-list.php seja a página de listagem
    exit(); // Para garantir que o código pare de ser executado aqui após o redirecionamento
} else {
    echo "ID não encontrado!";
}
?>
