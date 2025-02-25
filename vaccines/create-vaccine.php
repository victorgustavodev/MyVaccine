<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-adm.php';


// Verifica se o usuário não está logado ou não tem o papel de 'admin'
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo "Acesso restrito. Você precisa ser administrador para acessar esta página.";
     exit;
 }

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $min_age = $_POST['min_age'];
    $max_age = $_POST['max_age'];
    $validate = $_POST['validate']; // Data de validade
    $contraindications = $_POST['contraindications'];

    $stmt = $pdo->prepare("INSERT INTO vaccines (name, min_age, max_age, validate, contraindications) VALUES (?, ?, ?, ?, ?)");

    // Executa a instrução SQL com os dados do formulário
    $stmt->execute([$name, $min_age, $max_age, $validate, $contraindications]);

    // Redireciona para a página de administração após a inserção
    header('Location: ../vaccines/read-vaccine.php');
    exit();
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
    <title>Cadastrar vacina</title>
</head>

<body class="h-screen">

    <navbar class="px-[6%] h-[8%] flex justify-between items-center navbar text-[#100E3D] bg-white shadow-md">
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="w-[190px]" /></a>
        <div class="flex gap-[64px] text-[16px]">
            <ul class="flex gap-4">
                <li>
                    <p href="../index.php" class="font-bold">Modo Admin</p>
                </li>
                <li><a href="../routes/logout.php" class="font-bold text-red-500">Sair</a></li>
            </ul>
        </div>
    </navbar>
    <main class="flex w-screen h-[92%] items-center justify-center">
        <div class="bg-white w-[90%] md:w-[50%] p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold mb-4">Cadastrar Nova vacina</h2>

            <form method="POST" class="flex flex-col gap-3">
                <label class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" class="w-full border p-2 rounded-md mb-3" name="name" required>

                <div class="flex gap-4">
                    <div class="flex flex-col w-1/2">
                        <label class="block text-sm font-medium text-gray-700">Idade mínima</label>
                        <input type="number" class="w-full border p-2 rounded-md mb-3" name="min_age" required>
                    </div>
                    <div class="flex flex-col w-1/2">
                        <label class="block text-sm font-medium text-gray-700">Idade mínima</label>
                        <input type="number" class="w-full border p-2 rounded-md mb-3" name="max_age" required>
                    </div>
                </div>

                <label class="block text-sm font-medium text-gray-700">Validade</label>
                <input type="date" class="w-full border p-2 rounded-md mb-3" name="validate" required>

                <label class="block text-sm font-medium text-gray-700">Contraindicações</label>
                <input type="text" class="w-full border p-2 rounded-md mb-3" name="contraindications" required>

                <div class="w-full flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-8 py-2 rounded-md hover:bg-blue-600">
                        Criar
                    </button>
                </div>
            </form>
        </div>
    </main>

</body>

</html>