<?php
session_start(); // Inicia a sessão

// Destroi todas as variáveis de sessão
$_SESSION = array();
session_destroy();

// Redireciona para a página de login ou inicial
header("Location: ../pages/login.php");
exit();
?>
