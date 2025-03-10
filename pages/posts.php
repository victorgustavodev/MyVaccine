<?php

session_start();

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    header('Location: ../admin');
    exit;
}

if (!isset($_SESSION['cpf'])) {
    header('Location: ./login.php');
}

require_once "../routes/db-connection.php";

// Prepara a consulta para buscar todos os postos
$stmt = $pdo->prepare("SELECT * FROM posts");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC); // Recupera todos os registros

// Verifica se há registros
if ($posts) {
    // Processar os dados (se necessário)
} else {
    // Opcional: Mensagem caso não haja postos
    $error_message = "Nenhum posto de vacinação encontrado.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../assets/style/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../assets/img/icon.png">
    <title>My Vaccine</title>
</head>

<body class="overflow-x-hidden min-h-screen text-[#100E3D] flex flex-col min-h-screen">

    <header>
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

    <main class="grow flex flex-col grow px-[6%] gap-[32px] my-[4rem] items-center">

        <div class="w-[600px] flex flex-col gap-3">
            <h1 class="text-[24px] text-center font-bold">Pesquisar postos de saúde</h1>
            <input id="searchInput" class="text-[16px] w-full p-3 border-[1px] rounded-[16px] border-black" type="text"
                placeholder="Insira a cidade que deseja pesquisar. Ex: Salvador">

        </div>


        <table class="min-w-full max-w-[100vw] bg-white border border-gray-200 shadow-md text-nowrap ">
            <thead class="">
                <tr class="bg-[#100E3D] text-left text-xs md:text-sm text-white">
                    <th class="font-light border-b py-2 px-6 rounded-tl-lg">Nome do Posto
                    </th>
                    <th class="font-light p-2 border-b w-1/4">Rua</th>
                    <th class="font-light p-2 border-b w-1/4">Cidade</th>
                    <th class="font-light p-2 ">Estado</th>
                    <th class="font-light p-2 rounded-tr-lg">Ações</th>
                </tr>
            </thead>
            <tbody>

                <?php if (empty($posts)): ?>
                <tr>
                    <td colspan="6" class="px-4 py-4 text-center text-gray-400">Nenhum posto cadastrado!</td>
                </tr>
                <?php endif; ?>
                <?php foreach ($posts as $post): ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['name'] ?></td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['address'] ?></td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['city'] ?></td>
                    <td class="px-2 py-2 border-b text-xs md:text-sm text-gray-800"><?= $post['state'] ?></td>
                    <td class="px-2 py-2 border-b text-xs md:text-xs flex gap-2 flex-col md:flex-row">

                        <a href="./vaccines.php?id=<?= $post['id']; ?>"
                            class="border-blue-500 border-2 text-blue-500 px-3 py-1 md:text-sm rounded-md transition all hover:bg-blue-500 hover:text-white flex gap-2 items-center">Visualizar
                            vacinas
                            <i class="fa-solid fa-syringe"></i>
                        </a>
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

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const rows = document.querySelectorAll("table tbody tr");

        searchInput.addEventListener("input", function() {
            const searchValue = searchInput.value.trim().toLowerCase();

            let foundResults = false;

            rows.forEach(row => {
                const stateCell = row.cells[2]; // Acessa a 4ª coluna (estado)

                if (stateCell) {
                    const stateText = stateCell.textContent.trim().toLowerCase();

                    if (stateText.includes(searchValue)) {
                        row.style.display = ""; // Exibe a linha
                        foundResults = true;
                    } else {
                        row.style.display = "none"; // Oculta a linha
                    }
                }
            });

            // Exibe ou esconde a linha de "Nenhum posto encontrado!"
            const noResultsRow = document.querySelector(".no-results");
            if (!foundResults) {
                if (!noResultsRow) {
                    const noResults = document.createElement("tr");
                    noResults.classList.add("no-results");
                    noResults.innerHTML =
                        '<td colspan="5" class="px-4 py-4 text-center text-gray-400">Nenhum posto encontrado!</td>';
                    document.querySelector("table tbody").appendChild(noResults);
                }
            } else {
                const noResults = document.querySelector(".no-results");
                if (noResults) {
                    noResults.remove(); // Remove a linha de "Nenhum posto encontrado!"
                }
            }
        });
    });


    function toggleMenu() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }
    </script>

    </main>

</html>