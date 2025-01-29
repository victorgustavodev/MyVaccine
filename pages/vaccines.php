<?php
require_once "authenticate.php"; // Verifica se o usuário é admin
require_once "../routes/db-connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vaccine_name = $_POST['vaccine_name'];
    $quantity = $_POST['quantity'];
    $min_age = $_POST['min_age'];
    $max_age = $_POST['max_age'];

    // Cadastro de vacina
    $stmt = $pdo->prepare("INSERT INTO vaccines (name, quantity, min_age, max_age, created_by) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$vaccine_name, $quantity, $min_age, $max_age, $_SESSION['user_id']]);

    echo "Vacina cadastrada com sucesso!";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
    <title>Admin - Dashboard de Vacinas</title>
</head>
<body>
    <section>
        <h1 class="text-2xl font-semibold">Cadastro de Vacinas</h1>
        <form action="vaccine-dashboard.php" method="POST">
            <div>
                <label for="vaccine_name">Nome da vacina:</label>
                <input type="text" name="vaccine_name" id="vaccine_name" required />
            </div>
            <div>
                <label for="quantity">Quantidade:</label>
                <input type="number" name="quantity" id="quantity" required />
            </div>
            <div>
                <label for="min_age">Idade mínima:</label>
                <input type="number" name="min_age" id="min_age" required />
            </div>
            <div>
                <label for="max_age">Idade máxima:</label>
                <input type="number" name="max_age" id="max_age" required />
            </div>
            <button type="submit">Cadastrar Vacina</button>
        </form>
    </section>
</body>
</html>
