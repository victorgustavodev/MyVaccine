<?php
// Inclui os arquivos necessários
require_once '../routes/db-connection.php';
require_once '../routes/authenticate-adm.php';

// Verifica se o ID do posto foi passado pela URL e se é um valor numérico válido
$stock_id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$stock_id || !is_numeric($stock_id)) {
    header('Location: ./404.php');
    exit;
}

// Busca o posto de vacinação
$stmt_post = $pdo->prepare("SELECT id, name FROM posts WHERE id = ?");
$stmt_post->execute([$stock_id]);
$stock = $stmt_post->fetch(PDO::FETCH_ASSOC);

if (!$stock) {
    echo "Posto de vacinação não encontrado.";
    exit;
}

// Busca as vacinas disponíveis no posto
$stmt_stocks = $pdo->prepare("
    SELECT v.name AS vaccine_name, v.min_age, v.max_age, v.contraindications, 
           s.quantity, s.batch, s.expiration_date, s.last_updated
    FROM stocks s
    INNER JOIN vaccines v ON s.vaccine_id = v.id
    WHERE s.post_id = ?
    ORDER BY v.name ASC
");

$stmt_stocks->execute([$stock_id]);
$stocks = $stmt_stocks->fetchAll(PDO::FETCH_ASSOC);

// Verifica se há vacinas cadastradas no estoque
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../assets/style/style.css" />
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../assets/img/icon.png">
    <title>Estoque de vacinas</title>
</head>

<body class="overflow-x-hidden flex flex-col text-[#100E3D] min-h-screen">


    <nav class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D] relative">
        <a href="/"><img src="../assets/img/logo.png" alt="logo" class="md:hidden w-[190px]" /></a>


        <!-- Desktop Menu -->
        <div class="hidden md:block w-full">

            <div class="flex w-full justify-between">
                <a href="../index.php"><img src="../assets/img/logo.png" alt="logo"
                        class="hidden md:block w-[190px]" /></a>
                <ul class="flex gap-12 uppercase text-[12px] transition-all">
                    <li class="cursor-pointer hover:font-semibold">
                        <a href="../index.php" class="cursor-pointer">home</a>
                    </li>
                    <li class="flex flex-col items-center">
                        <a href="./posts.php" class="cursor-pointer font-semibold">postos de vacinação</a>
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    </li>
                    <li class="cursor-pointer hover:font-semibold">
                        <a href="./history-vaccine.php" class="cursor-pointer hover:font-semibold">histórico de
                            vacinas</a>

                    </li>
                </ul>

                <?php if(isset($_SESSION['cpf'])): ?>
                <div class="flex items-center gap-4">
                    <span class="text-gray-700 text-sm font-semibold">Olá,
                        <?= htmlspecialchars($_SESSION['name']); ?>!</span>
                    <a href="../routes/logout.php"
                        class="bg-red-500 text-white px-4 py-2 text-xs md:text-sm rounded-md hover:bg-red-600 cursor-pointer">
                        Sair
                    </a>
                </div>
                <?php else: ?>
                <a href="./pages/login.php"
                    class="bg-blue-500 text-white px-4 py-2 text-xs md:text-sm rounded-md hover:bg-blue-600 cursor-pointer">
                    Login
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <button class="block md:hidden" onclick="toggleMenu()">
            <i class="fa-solid fa-bars text-xl"></i>
        </button>

        <!-- Mobile Menu -->
        <div id="mobileMenu"
            class="hidden absolute top-[8vh] left-0 w-full bg-white shadow-md md:hidden flex flex-col items-center p-4">
            <ul class="flex flex-col items-center gap-4 text-[14px]">
                <li class="cursor-pointer font-semibold"><a href="#">Home</a></li>
                <li class="cursor-pointer hover:font-semibold"><a href="./pages/posts.php">Postos de Vacinação</a></li>
                <li class="cursor-pointer hover:font-semibold">Histórico de Vacinas</li>
                <li class="cursor-pointer hover:font-semibold">Sobre</li>
            </ul>
            <div class="mt-4">
                <?php if(isset($_SESSION['cpf'])): ?>
                <a href="./routes/logout.php"
                    class="bg-red-500 text-white px-4 py-2 text-sm rounded-md hover:bg-red-600 cursor-pointer">
                    Sair
                </a>
                <?php else: ?>
                <a href="./pages/login.php"
                    class="bg-blue-500 text-white px-4 py-2 text-sm rounded-md hover:bg-blue-600 cursor-pointer">
                    Login
                </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <main class="flex flex-col px-[6%] gap-[32px] my-[4rem] grow items-center">

        <div class="w-[600px] flex flex-col gap-3">
            <h1 class="text-[24px] text-center font-bold">Filtrar vacinas</h1>
            <div class="flex items-center gap-3">
                <a href='posts.php'>
                    <i class="fa-solid fa-arrow-left text-[24px]"></i>
                </a>
        <input id="searchInput" class="text-[16px] w-full p-3 border-[1px] rounded-[16px] border-black flex" type="text" placeholder="Insira o nome da vacina">
    </div>
        </div>

        <table class="min-w-full max-w-[100vw] bg-white border border-gray-200 shadow-md text-nowrap">
            <thead>
                <tr class="bg-[#100E3D] text-left text-xs md:text-sm text-white">
                    <th class="font-light py-3 px-2 p w-1/5 border-b rounded-tl-lg">Vacina</th>
                    <th class="font-light px-2 py-2 border-b w-1/5">Quantidade em estoque</th>
                    <th class="font-light px-2 py-2 border-b w-1/5">Faixa Etária</th>
                    <th class="font-light px-2 py-2 border-b w-1/5 rounded-tr-lg">Contraindicações</th>

                </tr>
            </thead>

            <tbody>

                <?php if (empty($stocks)): ?>
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-400">Nenhuma vacina cadastrada nesse
                        posto!</td>
                </tr>
                <?php endif; ?>

                <?php foreach ($stocks as $stock): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $stock['vaccine_name'] ?>
                    </td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $stock['quantity'] ?></td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800">
                        <?= $stock['min_age'] ?> - <?= $stock['max_age'] ?? 'Sem limite' ?> anos
                    </td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800">
                        <?= $stock['contraindications'] ?: 'Nenhuma' ?>
                    </td>


                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

    </main>

    <footer class=" bg-[#100E3D] text-white py-8 md:mt-12 px-[6%]">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <!-- Logo e Nome -->
            <div class="flex flex-col items-center md:items-start">
                <img src="../assets/img/logo-white.png" alt="Logo My Vaccine" class="w-40 mb-2">
                <p class="text-sm text-gray-400">Facilitando o acesso à vacinação.</p>
            </div>

            <!-- Links -->
            <div class="flex flex-wrap justify-center gap-6 mt-6 md:mt-0">
                <a href="../index.php" class="text-sm hover:underline">Home</a>
                <a href="./posts.php" class="text-sm hover:underline">Postos de Vacinação</a>
                <a href="./history-vaccine.php" class="text-sm hover:underline">Histórico de Vacinas</a>
            </div>

            <!-- Redes Sociais -->
            <div class="flex gap-4 mt-6 md:mt-0">
                <button href="" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-facebook"></i></button>
                <button href="" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-instagram"></i></button>
                <button href="" class="text-gray-400 hover:text-white text-xl"><i class="fab fa-twitter"></i></button>
            </div>
        </div>

        <!-- Direitos Autorais -->
        <div class="text-center text-gray-400 text-xs mt-6 border-t border-gray-600 pt-4">
            &copy; 2025 My Vaccine. Todos os direitos reservados.
        </div>

    </footer>

    <script src="../assets/js/filter.js"></script>
</body>

</html>