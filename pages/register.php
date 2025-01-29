<?php

session_start();

require_once '../routes/db-connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $cpf = preg_replace('/[^0-9]/', '', $_POST['cpf']); // Remove qualquer caractere que não seja número
    $telephone = trim($_POST['telephone']);
    $dob = $_POST['dob'];
    $address = trim($_POST['address']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm-password']);

    // Validação básica
    if (empty($name) || empty($email) || empty($cpf) || empty($telephone) || empty($dob) || empty($address) || empty($password) || empty($confirm_password)) {
        die("Por favor, preencha todos os campos.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Email inválido.");
    }


    if ($password !== $confirm_password) {
        die("As senhas não coincidem.");
    }

    // if (!$hashed_password) {
    //     die("Erro ao gerar o hash da senha.");
    // }
    
    // Verifica se o CPF já existe no banco de dados

    $stmt = $pdo->prepare("SELECT * FROM clients WHERE cpf = ?");
    $stmt->execute([$cpf]);
    if ($stmt->rowCount() > 0) {
        echo "CPF já cadastrado!";
        exit;
    }

    // Insere o novo usuário
    $stmt = $pdo->prepare("INSERT INTO clients (name, email, cpf, password, dob, address, telephone) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $cpf, $password, $dob, $address, $telephone])) {
        // echo "Cadastro realizado com sucesso!";
        header ('Location: ../index.php');
    } else {
        echo "Erro ao cadastrar cliente.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="./assets/img/icon.png">
    <title>Register - My Vaccine</title>
</head>

<body class="overflow-x-hidden">

    <!-- navbar -->
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
        <!-- left login -->
        <section class="flex justify-center items-center w-full lg:w-[60vw] h-[92vh]">
            <form method="POST"
                class="flex flex-col gap-3 px-6 mt-[25vh] md:mt-0 lg:px-[32px] py-6 m:py:0 w-full lg:w-4/6 justify-center">
                <h1 class="text-2xl font-semibold">Cadastro</h1>

                <!-- Nome Completo -->
                <div class="flex flex-col gap-2">
                    <label for="name">Nome Completo:</label>
                    <input type="text" name="name" id="name" class="border-2 p-3 rounded-lg"
                        placeholder="Digite seu nome completo" required />
                </div>

                <!-- Email -->
                <div class="flex flex-col gap-2">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="border-2 p-3 rounded-lg"
                        placeholder="Digite seu email" required />
                </div>

                <div class="flex gap-3 w-full">
                    <!-- CPF -->

                    <div class="flex flex-col gap-2 w-1/2">
                        <label for="cpf">CPF:</label>
                        <input type="text" name="cpf" id="cpf" class="border-2 p-3 rounded-lg"
                            placeholder="Digite seu CPF" required />
                    </div>

                    <!-- Telefone -->
                    <div class="flex flex-col gap-2 w-1/2">
                        <label for="telephone">Telefone:</label>
                        <input type="text" name="telephone" id="telephone" class="border-2 p-3 rounded-lg"
                            placeholder="(00) 00000-0000" required maxlength="15" oninput="formatPhone(this)" />
                    </div>
                </div>

                <!-- Data de Nascimento -->
                <div class="flex flex-col gap-2">
                    <label for="dob">Data de Nascimento:</label>
                    <input type="date" name="dob" id="dob" class="border-2 p-3 rounded-lg" required />
                </div>

                <!-- Endereço -->
                <div class="flex flex-col gap-2">
                    <label for="address">Endereço:</label>
                    <input type="text" name="address" id="address" class="border-2 p-3 rounded-lg"
                        placeholder="Digite seu endereço" required />
                </div>

                <!-- Senha -->
                <div class="flex flex-col gap-2">
                    <label for="password">Senha:</label>
                    <input type="password" name="password" id="password" class="border-2 p-3 rounded-lg"
                        placeholder="Digite sua senha" required />
                </div>

                <!-- Confirmar Senha -->
                <div class="flex flex-col gap-2">
                    <label for="confirm-password">Confirmar Senha:</label>
                    <input type="password" name="confirm-password" id="confirm-password" class="border-2 p-3 rounded-lg"
                        placeholder="Confirme sua senha" required />
                </div>

                <!-- Botões -->

                <div class="flex flex-col sm:flex-row gap-3 w-full text-xs md:text-base text-center sm:text-start mt-5">

                    <button type="submit"
                        class="bg-[#0B5FFF] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#074DD2] cursor-pointer">
                        Cadastrar
                    </button>

                    <a href="login.php"
                        class="bg-[#000A2E] text-white font-semibold py-4 px-10 rounded-lg hover:bg-[#1A2C6F]">
                        Já possuo conta
                    </a>

                </div>
            </form>
        </section>

        <!-- right login -->
        <div class="flex lg:w-[40vw] hidden lg:block" style="
      background-image: url(../assets/img/bg-login.png);
      background-repeat: no-repeat;
      background-size: cover;
    "></div>
    </div>

    <script src="../assets//script/script.js"></script>

</body>

</html>