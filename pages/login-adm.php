<?php
session_start();
require_once "../routes/db-connection.php";

if (!isset($_SESSION['user_id'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit;
}

// Verifica se o usuário logado é um administrador
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM admin WHERE id = ?");
$stmt->execute([$user_id]);

$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$admin) {
    // Se não for admin, redireciona para uma página de acesso negado
    header("Location: access-denied.php");
    exit;
}
?>


<form method="POST">
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Senha:</label>
    <input type="password" name="password" required>
    <button type="submit">Entrar</button>
</form>
