<?php

session_start();

if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'admin') {
    header('Location: ./admin');
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

<body class="overflow-x-hidden text-[#100E3D]">
    
    <header>
        <nav class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D] relative">
            <a href=""><img src="./assets/img/logo.png" alt="logo" class="md:hidden w-[190px]" /></a>


            <!-- Desktop Menu -->
            <div class="hidden md:block w-full">

                <div class="flex w-full justify-between">
                    <a href=""><img src="./assets/img/logo.png" alt="logo" class="hidden md:block w-[190px]" /></a>
                    <ul class="flex gap-12 uppercase text-[12px] transition-all">
                        <li class="flex flex-col items-center">
                            <a href="" class="cursor-pointer font-semibold">home</a>
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        </li>
                        <a href="./pages/posts.php" class="cursor-pointer hover:font-semibold">postos de vacinação</a>
                        <a href="./pages/history-vaccine.php" class="cursor-pointer hover:font-semibold">histórico de
                            vacinas</a>

                    </ul>

                    <?php if (isset($_SESSION['cpf'])): ?>
                    <div class="flex items-center gap-4">
                        <span class="text-gray-700 text-sm font-semibold">Olá,
                            <?= ($_SESSION['name']); ?>
                        </span>
                        <a href="./routes/logout.php"
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
                class="hidden absolute top-[8vh] right-0 w-2/3 rounded-br-lg rounded-bl-lg bg-white shadow-md md:hidden flex flex-col items-center p-4">
                <ul class="flex flex-col items-center gap-4 text-[14px]">
                    <li class="cursor-pointer font-semibold"><a href="#">Home</a></li>
                    <li class="cursor-pointer hover:font-semibold"><a href="./pages/posts.php">Postos de Vacinação</a>
                    </li>
                    <li class="cursor-pointer hover:font-semibold"><a href="./pages/history-vaccine.php">Histórico de vacinação</a></li>
                </ul>
                <div class="mt-6 mb-3">
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
    </header>

    <main
        class="md:h-[70vh] flex flex-col md:flex-row justify-center px-[6%] gap-[32px] md:gap-[64px] lg:gap-[120px] mt-[4rem]">
        <div class="flex flex-col justify-center gap-2 md:gap-6 max-w-[640px]">
            <h1 class="font-bold text-[24px] lg:text-[40px]">Encontre <span class="text-blue-400">postos de
                    vacinação</span> próximos a você.</h1>
            <p class="text-[10px] md:text-base text-gray-400">O My Vaccine facilita o acesso à vacinação, permitindo que
                você
                encontre postos de saúde, consulte vacinas disponíveis e gerencie seu histórico de imunização de forma
                prática e segura.</p>
            <div class="transition-all">
                <a href="./pages/posts.php"
                    class="bg-blue-500 text-white px-4 md:px-8 py-2 text-[8px] md:text-xs md:text-sm rounded-md hover:bg-blue-600 cursor-pointer">
                    Encontrar Postos
                </a>
            </div>
        </div>

        <div class="flex justify-center items-center">
            <img src="./assets/img/vetor-main.jpg" alt="Vacinação" class="w-[250px]  md:w-[500px] md:min-w-[400px]">
        </div>
    </main>

    <section class="px-[6%] py-[2rem] md:pb-[4rem] border-b-[1px] border-[#EEE]">
        <ul class="flex justify-evenly flex-col md:flex-row gap-6 md:gap-[40px] justify-center px-[6%]">
            <li class="flex gap-2 md:gap-4 justify-center items-center">
                <img src="./assets/img/check-heart-icon.png" alt="" class="w-[30px] md:w-[40px]">
                <span class="flex flex-col">
                    <p class="font-semibold text-[8px] md:text-[16px]">Imunização Segura</p>
                    <p class="text-[8px] md:text-[12px] text-gray-400 min-w-[200px]">Encontre vacinas recomendadas para
                        você.</p>
                </span>
            </li>

            <li class="flex gap-2 md:gap-4 justify-center items-center">
                <img src="./assets/img/health-check-icon.png" alt="" class="w-[30px] md:w-[40px]">

                <span class="flex flex-col">
                    <p class="font-semibold text-[8px] md:text-[16px]">Gestão Inteligente</p>
                    <p class="text-[8px] md:text-[12px] text-gray-400 min-w-[200px]">Postos podem atualizar estoques em
                        tempo real.
                    </p>
                </span>
            </li>

            <li class="flex gap-2 md:gap-4 justify-center items-center">
                <img src="./assets/img/syringe-vaccine-icon.png" alt="" class="w-[30px] md:w-[40px]">
                <span class="flex flex-col">
                    <p class="font-semibold text-[8px] md:text-[16px]">Histórico de Vacinas</p>
                    <p class="text-[8px] md:text-[12px] text-gray-400 min-w-[200px]">Acompanhe suas doses e próximas
                        aplicações.
                    </p>
                </span>

            </li>
        </ul>

    </section>

    <!-- image in right -->
    <section class="py-[2rem] flex justify-center">
        <div class="px-[6%] md:w-[1252px] flex flex-col md:flex-row justify-between items-center">
            <div class="flex flex-col gap-3 md:gap-8 min-w-[150px] max-w-[516px] pr-8">
                <h1 class="font-bold text-[16px] md:text-[30px]">Dados seguros e sempre <span
                        class="text-blue-400">disponíveis.</span></h1>
                <p class="text-[10px] md:text-[16px]">O My Vaccine protege suas informações com segurança e
                    confiabilidade. Todos os dados são armazenados de forma segura, garantindo que você tenha acesso
                    rápido e confiável sempre que precisar.</p>
            </div>
            <figure>
                <img src="./assets/img/vetor-section-1.jpg" alt="" class="w-[150px] md:w-[500px]"">
                </figure>
            </div>
        </section>

        <!-- image in left -->
        <section class=" py-[2rem] flex justify-center">
                <div class="px-[6%] md:w-[1252px] flex flex-col-reverse md:flex-row justify-between items-center">
                    <figure class="w-1/2 md:w-auto">
                        <img src="./assets/img/vetor-section-2.png" alt="" class="w-[150px] md:w-[500px]">
                    </figure>
                    <div class="flex flex-col gap-3 md:gap-8 min-w-[150px] max-w-[516px]">
                        <h1 class="font-bold text-[16px] md:text-[30px]">Acompanhe a disponibilidade de vacinas em<span
                                class="text-blue-400"> tempo real.</span> </h1>
                        <p class="text-[10px] md:text-[16px]">Com o My Vaccine, você pode consultar rapidamente a
                            disponibilidade de vacinas em diferentes postos de saúde. Acesse informações atualizadas
                            sobre estoques e planeje sua vacinação de forma prática e sem complicações.</p>
                    </div>
                </div>
    </section>

    <!-- image in right -->
    <section class="py-[2rem] flex justify-center">
        <div class="px-[6%] md:w-[1252px] flex flex-col md:flex-row justify-between items-center">
            <div class="flex flex-col gap-3 md:gap-8 min-w-[150px] max-w-[516px] pr-8">
                <h1 class="font-bold text-[16px] md:text-[30px]">Localize
                    postos de saúde com <span class="text-blue-400">facilidade.</span></h1>
                <p class="text-[10px] md:text-[16px]">Com nossa ferramenta de busca, você encontra rapidamente os postos
                    de vacinação mais próximos da sua localização. Visualize endereços, horários de funcionamento e
                    vacinas disponíveis de forma simples e acessível.</p>
            </div>
            <figure>
                <img src="./assets/img/vetor-section-3.png" alt="" class="w-[150px] md:w-[500px]"">
                </figure>
            </div>
    </section>

    <footer class=" bg-[#100E3D] text-white py-8 md:mt-12 px-[6%]">
                <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                    <!-- Logo e Nome -->
                    <div class="flex flex-col items-center md:items-start">
                        <img src="./assets/img/logo-white.png" alt="Logo My Vaccine" class="w-40 mb-2">
                        <p class="text-sm text-gray-400">Facilitando o acesso à vacinação.</p>
                    </div>

                    <!-- Links -->
                    <div class="flex flex-wrap justify-center gap-6 mt-6 md:mt-0">
                        <a href="./index.php" class="text-sm hover:underline">Home</a>
                        <a href="./pages/posts.php" class="text-sm hover:underline">Postos de Vacinação</a>
                        <a href="./pages/history-vaccine.php" class="text-sm hover:underline">Histórico de Vacinas</a>
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

<script src=" ./assets/js/index.js"></script>

<script>
function toggleMenu() {
    document.getElementById('mobileMenu').classList.toggleMenu('hidden');
}
</script>
</body>

</html>