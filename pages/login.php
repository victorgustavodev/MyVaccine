<?php
require_once "../routes/db-connection.php";
session_start();

$erroCpfEmailPassowrd = "<script>alert('CPF, Email ou senha incorretos!'); window.location.href = './login.php';</script>";

if (isset($_SESSION['name'])) {
    header('Location: ../index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']); // Pode ser CPF ou email
    $password = $_POST['password'];

    // Verifica se o input é um CPF (somente números)
    if (preg_match('/^[0-9]{11}$/', $login)) {
        $query = "SELECT * FROM users WHERE cpf = ?";
    } else {
        $query = "SELECT * FROM users WHERE email = ?";
    }

    // Prepara e executa a query
    $stmt = $pdo->prepare($query);
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se usuário existe e se a senha está correta
    if (!$user || !password_verify($password, $user['password'])) {
        echo $erroCpfEmailPassowrd;
        exit;
    }

    // Define as variáveis de sessão
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['cpf'] = $user['cpf'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['name']; 
    $_SESSION['user_role'] = $user['role'];

    // Redirecionamento com base na função do usuário
    if ($user['role'] === "usuario") {
        header('Location: ../index.php');
        exit;
    } else if ($user['role'] === "admin") {
        echo $erroCpfEmailPassowrd; // exibe msg de erro
        session_destroy(); // destroi a sessão para que não seja iniciada, mesmo após o erro.
        exit;
    }

    exit;
}
?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>Login - My Vaccine</title>
</head>

<body class="overflow-x-hidden h-screen">

    <nav class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D] relative">
        <a href="/"><img src="../assets/img/logo.png" alt="logo" class="md:hidden w-[190px]" /></a>


        <!-- Desktop Menu -->
        <div class="hidden md:block w-full">

            <div class="flex w-full justify-between">
                <a href="../index.php"><img src="../assets/img/logo.png" alt="logo"
                        class="hidden md:block w-[190px]" /></a>
                <ul class="flex gap-12 uppercase text-[12px] transition-all">
                    <li class="flex flex-col items-center">
                        <a href="../index.php" class="cursor-pointer font-semibold">home</a>
                        <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                    </li>
                    <li><a href="./posts.php" class="cursor-pointer hover:font-semibold">postos de vacinação</a></li>
                    <li class="cursor-pointer hover:font-semibold"><a href="./vaccines.php">histórico de vacinas</a></li>
                </ul>

                <?php if(isset($_SESSION['cpf'])): ?>
                <div class="flex items-center gap-4">
                    <span class="text-gray-700 text-sm font-semibold">Olá,
                        <?= htmlspecialchars($_SESSION['name']); ?>!</span>
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

    <div class="w-full flex">

        <!-- Left login background (imagem) -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-r from-blue-900 to-blue-950">
        </div>

        <!-- Right login form -->
        <section class="flex md:justify-center md:items-center w-full lg:w-1/2 h-[92vh]">
            <form action="login.php" method="POST"
                class="text-[12px] 2xl:text-base flex flex-col gap-2 2xl:gap-3 px-6 lg:px-[32px] w-full lg:w-4/6 pt-[3rem] md:pt-[0] md:justify-center">
                <h1 class="text-xl 2xl:text-2xl font-semibold">Login</h1>

                <!-- Campo Login (CPF ou Email) -->
                <div class="flex flex-col gap-2">
                    <label for="login">CPF ou Email:</label>
                    <input type="text" name="login" id="login" class="border-2 p-2 2xl:p-3 rounded-lg"
                        placeholder="Digite seu CPF ou Email" required />
                </div>

                <!-- Campo Senha -->
                <div class="flex flex-col gap-2">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" id="password" class="border-2 p-2 2xl:p-3 rounded-lg"
                        placeholder="Digite sua senha" required />
                </div>

                <!-- Link para recuperar senha -->
                <!-- <a href="./forgot-password.php" class="text-end text-cyan-500 hover:underline">Esqueceu a senha?</a> -->

                <!-- Botões -->
                <div class="flex flex-col sm:flex-row gap-3 w-full text-xs md:text-base text-center sm:text-start mt-5">
                    <button type="submit"
                        class="bg-[#0B5FFF] text-[12px] 2xl:text-base text-white font-semibold py-2 px-8 2xl:py-4 2xl:px-10 rounded-lg hover:bg-[#074DD2] cursor-pointer">
                        Login
                    </button>

                    <a href="register.php"
                        class="bg-[#000A2E] text-[12px] 2xl:text-base text-white font-semibold py-2 px-8 2xl:py-4 2xl:px-10 rounded-lg hover:bg-[#1A2C6F]">
                        Criar conta
                    </a>
                </div>
            </form>
        </section>

    </div>

    <script src="../assets/script/script.js"></script>
    <script>
    function toggleMenu() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }
    </script>
</body>

</html>