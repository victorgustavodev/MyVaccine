<?php
// Inclui o arquivo de conexão com o banco de dados
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-post.php';

// Verifica se um ID foi passado via GET e se é um número válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = (int) $_GET['id']; // Converte para inteiro para evitar SQL Injection


// Obtém o ID do post a partir da URL usando o método GET
$id = $_GET['id'];

// Prepara a instrução SQL para selecionar o post pelo ID
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");

// Executa a instrução SQL, passando o ID do post como parâmetro
$stmt->execute([$id]);

// Recupera os dados do post como um array associativo
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o formulário foi submetido através do método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo formulário
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    
    // Prepara a instrução SQL para atualizar os dados do post
    $stmt = $pdo->prepare("UPDATE posts SET name = ?, address = ?, city = ?, state = ? WHERE id = ?");
    
    // Executa a instrução SQL com os novos dados do formulário
    $stmt->execute([$name, $address, $city, $state, $id]);
    
    // Redireciona para a página de listagem de posts após a atualização
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
    <title>Editar Posto</title>
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
            <h2 class="text-lg font-bold mb-4">Editar posto</h2>

            <form method="POST" class="flex flex-col gap-3">
                <label class="block text-sm font-medium text-gray-700">Nome do Posto</label>
                <input type="text" class="w-full border p-2 rounded-md mb-3" name="name" required
                    value="<?= $post['name'] ?>">

                <label class="block text-sm font-medium text-gray-700">Rua</label>
                <input type="text" class="w-full border p-2 rounded-md mb-3" name="address" required
                    value="<?= $post['address'] ?>">

                <label class="block text-sm font-medium text-gray-700">Cidade</label>
                <input type="text" class="w-full border p-2 rounded-md mb-3" name="city" required
                    value="<?= $post['city'] ?>">


                <label class="block text-sm font-medium text-gray-700">Estado</label>
                <select name="state" class="w-full border p-2 rounded-md mb-3">
                    <option value="<?= $post['state'] ?>"><?= $post['state'] ?></option>
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
                        Editar
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>