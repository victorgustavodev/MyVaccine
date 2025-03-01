<?php
// Inclui os arquivos necessários
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-adm.php';

// Verifica se o usuário tem permissão para acessar a página
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo "Acesso restrito. Você precisa ser administrador para acessar esta página.";
    exit;
}

// Obtém o ID do posto via GET
if (!isset($_GET['id'])) {
    echo "ID do posto não fornecido.";
    exit;
}

$post_id = $_GET['id'];

// Buscar vacinas cadastradas e suas quantidades para o posto específico
$stmt_stocks = $pdo->prepare("
    SELECT v.id AS vaccine_id, v.name AS vaccine_name, COALESCE(s.quantity, 0) AS quantity 
    FROM vaccines v 
    LEFT JOIN stocks s ON v.id = s.vaccine_id AND s.post_id = ?
    ORDER BY v.name ASC
");
$stmt_stocks->execute([$post_id]);
$stocks = $stmt_stocks->fetchAll(PDO::FETCH_ASSOC);

// Processa o formulário ao enviar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $vaccine_id = $_POST['vaccine_id'];
    $quantity = $_POST['quantity'];
    $batch = $_POST['batch'];
    $expiration_date = $_POST['expiration_date'];

    // Verifica se os campos não estão vazios
    if (!empty($vaccine_id) && !empty($quantity)) {
        $stmt = $pdo->prepare("INSERT INTO stocks (post_id, vaccine_id, quantity, batch, expiration_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$post_id, $vaccine_id, $quantity, $batch, $expiration_date]);

        // Redireciona para a página de administração após a inserção
        header('Location: ../stocks/read-stock.php?id=' . $post_id);
        exit();
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>Cadastrar Estoque de Vacinas</title>
</head>

<body class="h-screen">
    <navbar class="px-[6%] h-[8%] flex justify-between items-center navbar text-[#100E3D] bg-white shadow-md">
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="w-[190px]" /></a>
        <div class="flex gap-[64px] text-[16px]">
            <ul class="flex gap-4">
                <li>
                    <p class="font-bold">Modo Admin</p>
                </li>
                <li><a href="../routes/logout.php" class="font-bold text-red-500">Sair</a></li>
            </ul>
        </div>
    </navbar>

    <main class="flex w-screen h-[92%] items-center justify-center">
        <div class="bg-white w-[90%] md:w-[50%] p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold mb-4">Cadastrar Estoque de Vacinas</h2>

            <form method="POST" class="flex flex-col gap-3">
                <!-- Seleção da Vacina -->
                <label class="block text-sm font-medium text-gray-700">Vacina</label>
                <select name="vaccine_id" class="w-full border p-2 rounded-md mb-3" required>
                    <option value="">Selecione uma vacina</option>
                    <?php foreach ($stocks as $stock): ?>
                    <option value="<?= $stock['vaccine_id']; ?>"><?= htmlspecialchars($stock['vaccine_name']); ?>
                        (Quantidade: <?= htmlspecialchars($stock['quantity']); ?>)</option>
                    <?php endforeach; ?>
                </select>

                <!-- Quantidade -->
                <label class="block text-sm font-medium text-gray-700">Quantidade</label>
                <input type="number" class="w-full border p-2 rounded-md mb-3" name="quantity" min="1" required>

                <!-- Numero do lote -->
                <label class="block text-sm font-medium text-gray-700">Lote:</label>
                <input type="text" class="w-full border p-2 rounded-md mb-3" name="batch" min="1" required>


                <!-- Validade do Lote -->
                <label class="block text-sm font-medium text-gray-700">Validade do lote:</label>
                <input type="date" class="w-full border p-2 rounded-md mb-3" name="expiration_date" min="1" required>

                <!-- Botão de Enviar -->
                <div class="w-full flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-8 py-2 rounded-md hover:bg-blue-600">
                        Adicionar ao Estoque
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>