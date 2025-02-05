<?php 
// Inclui o arquivo de conexão com o banco de dados
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-adm.php';

// Obtém o ID do aluno a ser excluído a partir da URL usando o método GET
$id = $_GET['id'];

// Prepara a instrução SQL para excluir o aluno pelo ID
$stmt = $pdo->prepare("DELETE FROM vaccines WHERE id = ?");

// Executa a instrução SQL com o ID do aluno
$stmt->execute([$id]);

// Redireciona para a página de listagem de alunos após a exclusão
header('Location: ../vaccines/read-vaccine.php');

?>