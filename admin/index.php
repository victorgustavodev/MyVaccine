<?php
require_once "../routes/db-connection.php";
session_start();

if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    header('Location: ../posts/read-post.php');
    exit;
} elseif (!isset($_SESSION['name'])) {
}


// Verifica se o usuário não está logado ou não tem o papel de 'admin'

$erroCpfEmailPassowrd = "<script>alert('CPF, Email ou senha incorretos!'); window.location.href = '';</script>";

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

    // Se não encontrou o usuário
    if (!$user) {
        echo $erroCpfEmailPassowrd;
        exit;
    }

    // Verifica a senha
    // if (!password_verify($password, $user['password'])) {
    //     echo $erroCpfEmailPassowrd;
    //     exit;
    // }

    // Define as variáveis de sessão
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['cpf'] = $user['cpf'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['name'] = $user['name']; 
    $_SESSION['user_role'] = $user['role'];

    // Redirecionamento com base na função do usuário
    if ($user['role'] == "admin") {
        header('Location: ../posts/read-post.php');
    } else {
        header('Location: ../routes/logout.php');
    }
    exit;
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<script src="../assets/js/password.js"></script>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>Login Admin - My Vaccine</title>
</head>

<body class="overflow-x-hidden h-screen">

    <nav class="px-[6%] h-[8%] flex justify-between items-center navbar text-[#100E3D] bg-white shadow-md">
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="w-[140px] 2xl:w-[190px]" /></a>
    </nav>

    <div class="w-full flex">

        <!-- Left login background (imagem) -->
        <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-r from-[#686E1A] to-[#3D130E]">
        </div>

        <!-- Right login form -->
        <section class="flex justify-center items-center w-full lg:w-1/2 h-[92vh]">
            <form action="index.php" method="POST"
                class="text-[12px] 2xl:text-base flex flex-col gap-2 2xl:gap-3 px-6 lg:px-[32px] w-full lg:w-4/6 justify-center">
                <h1 class="text-xl 2xl:text-2xl font-semibold">Login Admin</h1>

                <!-- Campo Login (CPF ou Email) -->
                <div class="flex flex-col gap-2">
                    <label for="login">Email:</label>
                    <input type="text" name="login" id="login" class="border-2 p-2 2xl:p-3 rounded-lg"
                        placeholder="Digite seu Email" required />
                </div>

                <!--Senha -->
                <div class="flex flex-col gap-2 relative">
                     <label for="password">Senha:</label>
                     <input type="password" name="password" id="password" class="border-2 p-2 pr-10 2xl:p-3 rounded-lg" 
                     placeholder="Digite sua senha" required />
                     <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute right-3 top-12 text-gray-600">
                     <i id="eyeIcon1" class="fa-solid fa-eye-slash"></i>
                     </button>
                </div>
                <!-- Link para recuperar senha -->
                <!-- <a href="./forgot-password.php" class="text-end text-cyan-500 hover:underline">Esqueceu a senha?</a> -->

                <!-- Botões -->
                <div class="flex flex-col sm:flex-row gap-3 w-full text-xs md:text-base text-center sm:text-start mt-5">
                    <button type="submit"
                        class="bg-[#0B5FFF] text-[12px] 2xl:text-base text-white font-semibold py-2 px-8 2xl:py-4 2xl:px-10 rounded-lg hover:bg-[#074DD2] cursor-pointer">
                        Login
                    </button>
                </div>
            </form>
        </section>

    </div>

    <script src="../assets/script/script.js"></script>
</body>

</html>