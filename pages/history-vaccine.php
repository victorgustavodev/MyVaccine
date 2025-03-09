<?php
session_start();
require_once "../routes/db-connection.php";

// Verifica se o usuário está logado e é paciente
if (!isset($_SESSION['cpf']) || $_SESSION['user_role'] !== 'usuario') {
    echo "Acesso restrito. Faça login como paciente.";
    exit;
}

$cpf = $_SESSION['cpf'];

try {
    $stmt = $pdo->prepare("
        SELECT 
            vh.application_date,
            vh.batch,
            v.name AS vaccine_name,
            p.name AS post_name
        FROM vaccination_history vh
        JOIN vaccines v ON vh.vaccine_id = v.id
        JOIN posts p ON vh.post_id = p.id
        WHERE vh.user_cpf = ?
        ORDER BY vh.application_date DESC
    ");
    $stmt->execute([$cpf]);
    $vacinas_aplicadas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Erro ao buscar histórico de vacinas: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./assets/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <script src="../assets/js/index.js"></script>
    <title>My Vaccine</title>
</head>

<body class="overflow-x-hidden min-h-screen h-full text-[#100E3D] flex flex-col">

    <header>
        <nav class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D] relative">
            <a href="/"><img src="../assets/img/logo.png" alt="logo" class="md:hidden w-[190px]" /></a>

            <!-- Desktop Menu -->
            <div class="hidden md:block w-full">
                <div class="flex w-full justify-between">
                    <a href="../index.php"><img src="../assets/img/logo.png" alt="logo"
                            class="hidden md:block w-[190px]" /></a>
                    <ul class="flex gap-12 uppercase text-[12px] transition-all">
                        <li><a href="../index.php" class="cursor-pointer hover:font-semibold">home</a></li>
                        <li><a href="./posts.php" class="cursor-pointer hover:font-semibold">postos de vacinação</a>
                        </li>
                        <li class="flex flex-col items-center">
                            <a href="./history-vaccine.php" class="cursor-pointer font-semibold">histórico de
                                vacinas</a>
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
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
                    <li class="cursor-pointer hover:font-semibold"><a href="./pages/posts.php">Postos de Vacinação</a>
                    </li>
                    <li class="cursor-pointer hover:font-semibold">Histórico de Vacinas</li>
                    <li class="cursor-pointer hover:font-semibold">Sobre</li>
                </ul>
                <div class="mt-4">
                    <?php if(isset($_SESSION['cpf'])): ?>
                    <a href="../routes/logout.php"
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
    </header>

    <main class="px-[6%] gap-[32px] grow my-[4rem] items-center">
        <h1 class="text-2xl font-bold mb-6 md:mb-12 text-center">Histórico de Vacinação</h1>

        <?php if (count($vacinas_aplicadas) === 0): ?>
        <p class="text-gray-500 text-center">Você ainda não tomou nenhuma vacina registrada.</p>
        <?php else: ?>
        <div class="w-full bg-white shadow-md">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-[#100E3D] text-left text-sm text-white">
                        <th class="font-light py-2 px-4 rounded-tl-lg">Vacina</th>
                        <th class="font-light p-2">Posto</th>
                        <th class="font-light p-2">Data</th>
                        <th class="font-light p-2 rounded-tr-lg">Lote</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vacinas_aplicadas as $vacina): ?>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-2 px-4 text-sm text-gray-800"><?= htmlspecialchars($vacina['vaccine_name']) ?>
                        </td>
                        <td class="p-2 text-sm text-gray-800"><?= htmlspecialchars($vacina['post_name']) ?></td>
                        <td class="p-2 text-sm text-gray-800">
                            <?= date('d/m/Y H:i', strtotime($vacina['application_date'])) ?></td>
                        <td class="p-2 text-sm text-gray-800"><?= htmlspecialchars($vacina['batch']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
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

</body>

</html>