<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-post.php';

// Verifica se o usuário não está logado ou não tem o papel de 'admin'
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo "Acesso restrito. Você precisa ser administrador para acessar esta página.";
     exit;
 }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $address = $_POST['name'];
        $city = $_POST['city'];
        $state = $_POST['state'];

        $stmt = $pdo->prepare("INSERT INTO posts (name, address, city, state) VALUES (?, ?, ?, ?)");
        //    echo $name, $address, $city, $state;
        // Executa a instrução SQL com os dados do formulário
        $stmt->execute([$name, $address, $city, $state]);

        // Redireciona para a página de listagem de alunos após a inserção
        header('Location: ../pages/adm.php');
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
    <title>Adicionar postos</title>
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
            <h2 class="text-lg font-bold mb-4">Adicionar Novo Posto</h2>

            <form id="addPostoForm" method="POST" class="flex flex-col gap-3">
                <label class="block text-sm font-medium text-gray-700">Nome do Posto</label>
                <input type="text" class="w-full border p-2 rounded-md mb-3" name="name" required>

                <label class="block text-sm font-medium text-gray-700">Rua</label>
                <input type="text" class="w-full border p-2 rounded-md mb-3" name="address" required>

                <label class="block text-sm font-medium text-gray-700">Cidade</label>
                <input type="text" class="w-full border p-2 rounded-md mb-3" name="city" required>

                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="state" class="w-full border p-2 rounded-md mb-3">
                    <option value="" selected disabled>Selecione um estado</option>
                    <option value="AC">AC - Acre</option>
                    <option value="AL">AL - Alagoas</option>
                    <option value="AP">AP - Amapá</option>
                    <option value="AM">AM - Amazonas</option>
                    <option value="BA">BA - Bahia</option>
                    <option value="CE">CE - Ceará</option>
                    <option value="DF">DF - Distrito Federal</option>
                    <option value="ES">ES - Espírito Santo</option>
                    <option value="GO">GO - Goiás</option>
                    <option value="MA">MA - Maranhão</option>
                    <option value="MT">MT - Mato Grosso</option>
                    <option value="MS">MS - Mato Grosso do Sul</option>
                    <option value="MG">MG - Minas Gerais</option>
                    <option value="PA">PA - Pará</option>
                    <option value="PB">PB - Paraíba</option>
                    <option value="PR">PR - Paraná</option>
                    <option value="PE">PE - Pernambuco</option>
                    <option value="PI">PI - Piauí</option>
                    <option value="RJ">RJ - Rio de Janeiro</option>
                    <option value="RN">RN - Rio Grande do Norte</option>
                    <option value="RS">RS - Rio Grande do Sul</option>
                    <option value="RO">RO - Rondônia</option>
                    <option value="RR">RR - Roraima</option>
                    <option value="SC">SC - Santa Catarina</option>
                    <option value="SP">SP - São Paulo</option>
                    <option value="SE">SE - Sergipe</option>
                    <option value="TO">TO - Tocantins</option>
                </select>

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