<?php
require_once "../routes/db-connection.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = trim($_POST['login']); // Pode ser CPF ou email
    $password = $_POST['password'];

    // Verifica se o input parece um CPF (somente números)
    if (preg_match('/^[0-9]{11}$/', $login)) {
        // $login = preg_replace('/[^0-9]/', '', $login); // Remove qualquer formatação do CPF
        $query = "SELECT * FROM users WHERE cpf = ?";
    } else {
        $query = "SELECT * FROM users WHERE email = ?";
    }

    // Prepara e executa a query
    $stmt = $pdo->prepare($query);
    $stmt->execute([$login]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se encontrou o usuário e se a senha está correta
    if ($user && $user['password']) { 
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['cpf'] = $user['cpf'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['name'] = $user['name']; 
        $_SESSION['user_role'] = $user['role'];

        if ($user['role'] == "admin") {
            header('Location: ../pages/adm.php'); // Redireciona para a página inicial
        } else {
            header('Location: ../index.php');
        }
        exit;
    } else {
        echo "CPF, Email ou senha incorretos!";
    }
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

    <nav class="px-[6%] h-[8%] flex justify-between items-center navbar text-[#100E3D] bg-white shadow-md">
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="w-[140px] 2xl:w-[190px]" /></a>
    </nav>

    <div class="w-full flex">

        <!-- Left login background (imagem) -->
        <div class="hidden lg:flex lg:w-1/2 bg-cover bg-no-repeat"
            style="background-image: url(../assets/img/bg-login.png);">
        </div>

        <!-- Right login form -->
        <section class="flex justify-center items-center w-full lg:w-1/2 h-[92vh]">
    <form action="login.php" method="POST" class="text-[12px] 2xl:text-base flex flex-col gap-2 2xl:gap-3 px-6 lg:px-[32px] w-full lg:w-4/6 justify-center">
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
</body>

</html>