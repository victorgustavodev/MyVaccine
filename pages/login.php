<?php
    require_once "../routes/db-connection.php";
    session_start();
//   require_once "../routes/authenticate.php";
//   session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']); // Remove qualquer formatação do CPF
    $password = $_POST['password'];

    // Verifica se o CPF existe
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE cpf = ?");
    $stmt->execute([$cpf]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe e se a senha está correta
    if ($user && $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['cpf'] = $user['cpf'];  // Pode usar CPF 
        $_SESSION['name'] = $user['name']; // Para personalizar a experiência do usuário, por exemplo
        header('Location: ../index.php'); // Redireciona para a página inicial ou qualquer outra
        exit;
    } else {
      echo "CPF ou senha incorretos!";
    }
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
    <title>Login</title>
</head>

<body class="overflow-x-hidden">

    <navbar class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D]">
        <!-- logo -->
        <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="w-[190px]" /></a>
        <!-- options -->
        <div class="flex gap-[64px] text-[16px]">
            <ul class="flex gap-4 transition-all duration-500 ease-in-out">
                <li><a href="../index.php" class="hover:underline">Voltar para página principal</a></li>
            </ul>
        </div>
    </navbar>

    <div class="w-full flex">

        <!-- Left login background (imagem) -->
        <div class="flex lg:w-[40vw] hidden lg:block"
            style="background-image: url(../assets//img/bg-login.png); background-repeat: no-repeat; background-size: cover;">
        </div>

        <!-- Right login form -->
        <section class="flex justify-center items-center w-full lg:w-[60vw] h-[92vh]">
            <form action="login.php" method="POST"
                class="flex flex-col gap-3 px-6 lg:px-[32px] w-full lg:w-4/6 justify-center">
                <h1 class="text-2xl font-semibold">Login</h1>

                <!-- Campo CPF -->
                <div class="flex flex-col gap-2">
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="border-2 p-3 rounded-lg" placeholder="Digite seu CPF"
                        required />
                </div>

                <!-- Campo Senha -->
                <div class="flex flex-col gap-2">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" id="password" class="border-2 p-3 rounded-lg"
                        placeholder="Digite sua senha" required />
                </div>

                <!-- Link para recuperar senha -->
                <a href="./forgot-password.php" class="text-end text-cyan-500 hover:underline">Esqueceu a senha?</a>

                <!-- Botões -->
                <div class="flex flex-col sm:flex-row gap-3 w-full text-xs md:text-base text-center sm:text-start mt-5">
                    <button type="submit"
                        class="bg-[#0B5FFF] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#074DD2] cursor-pointer">
                        Login
                    </button>

                    <a href="register.php"
                        class="bg-[#000A2E] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#1A2C6F]">
                        Criar conta
                    </a>
                </div>
            </form>
        </section>
    </div>

    <script src="../../assets/js/script.js"></script>
</body>

</html>