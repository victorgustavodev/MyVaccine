<?php
    session_start();

    if (!isset($_SESSION['name'])) {
        header('Location: ../pages/login.php');
        exit();
    }
?>