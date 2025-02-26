<?php 
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-adm.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);

echo "Post excluído com sucesso!";
?>
