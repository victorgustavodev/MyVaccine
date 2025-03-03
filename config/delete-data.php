<?php
session_start();
require_once "../routes/db-connection.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = $_POST['action'];

    try {
        if ($action === "delete_posts") {
            $stmt = $conn->prepare("DELETE FROM posts");
            $stmt->execute();
            echo json_encode(["success" => true, "message" => "Todos os postos foram apagados!"]);
        } elseif ($action === "delete_vaccination_records") {
            $stmt = $conn->prepare("DELETE FROM vaccination_history");
            $stmt->execute();
            echo json_encode(["success" => true, "message" => "Todos os registros de vacinação foram apagados!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Ação inválida"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Erro ao apagar: " . $e->getMessage()]);
    }
}
?>
