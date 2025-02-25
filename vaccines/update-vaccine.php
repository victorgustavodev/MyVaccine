<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-adm.php';

// Verifica se um ID foi passado via GET e se é um número válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = (int) $_GET['id']; // Converte para inteiro para evitar SQL Injection


// Obtém o ID do vaccine a partir da URL usando o método GET
$id = $_GET['id'];

// Prepara a instrução SQL para selecionar o vaccine pelo ID
$stmt = $pdo->prepare("SELECT * FROM vaccines WHERE id = ?");

// Executa a instrução SQL, passando o ID do vaccine como parâmetro
$stmt->execute([$id]);

// Recupera os dados do vaccine como um array associativo
$vaccine = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o formulário foi submetido através do método vaccine
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo formulário
    $name = $_vaccine['name'];
    $min_age = $_vaccine['min_age'];
    $max_age = $_vaccine['max_age'];
    $validate = $_vaccine['validate'];
    $contraindications = $_vaccine['contraindications'];
    
    // Prepara a instrução SQL para atualizar os dados do vaccine
    $stmt = $pdo->prepare("UPDATE vaccines SET name = ?, min_age = ?, max_age = ?, validate = ?, contraindications = ? WHERE id = ?");
    
    // Executa a instrução SQL com os novos dados do formulário
    $stmt->execute([$name, $min_age, $max_age, $validate, $contraindications, $id]);
    
    // Redireciona para a página de listagem de vaccines após a atualização
    header('Location: ../vaccines/read-vaccine.php');
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
    <title>Editar vacina</title>
</head>

<body class="h-screen">
    <nav class="px-[6%] h-[8%] flex justify-between items-center navbar text-[#100E3D] bg-white shadow-md">
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="w-[190px]" /></a>
        <div class="flex gap-[64px] text-[16px]">
            <ul class="flex gap-4">
                <li>
                    <p href="../index.php" class="font-bold">Modo Admin</p>
                </li>
                <li><a href="../routes/logout.php" class="font-bold text-red-500">Sair</a></li>
            </ul>
        </div>
    </nav>


    <main class="flex w-screen h-[92%] items-center justify-center">
        <div class="bg-white w-[90%] md:w-[50%] p-6 rounded-lg shadow-lg">
            <h2 class="text-lg font-bold mb-4">Editar vacina</h2>

            <form method="POST" class="flex flex-col gap-3">
                <label class="block text-sm font-medium text-gray-700">Nome</label>
                <input type="text" class="w-full border p-2 rounded-md mb-3" name="name"
                    value="<?= $vaccine['name'] ?>">

                <label class="block text-sm font-medium text-gray-700">Idade mínima</label>
                <input type="number" class="w-full border p-2 rounded-md mb-3" name="min_age"
                    value="<?= $vaccine['min_age'] ?>">

                <label class="block text-sm font-medium text-gray-700">Idade máxima</label>
                <input type="number" class="w-full border p-2 rounded-md mb-3" name="max_age"
                    value="<?= $vaccine['max_age'] ?>">

                <label class="block text-sm font-medium text-gray-700">Validade</label>
                <input type="date" class="w-full border p-2 rounded-md mb-3" name="validate"
                    value="<?= $vaccine['validate'] ?>">

                <label class="block text-sm font-medium text-gray-700">Contra indicações</label>
                <textarea name="contraindications" class="w-full border p-2 rounded-md mb-3"
                    value="<?= $vaccine['contraindications'] ?>"></textarea>

                <div class="w-full flex justify-end">
                    <button type="submit" class="bg-blue-500 text-white px-8 py-2 rounded-md hover:bg-blue-600">
                        Salvar
                    </button>
                </div>
            </form>

        </div>
    </main>
</body>

</html>