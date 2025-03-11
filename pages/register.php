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
    $password = $_POST['password'];
    $confirm_password = trim($_POST['confirm-password']);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

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

    $stmt = $pdo->prepare("SELECT * FROM users WHERE cpf = ?");
    $stmt->execute([$cpf]);
    if ($stmt->rowCount() > 0) {
        echo "CPF já cadastrado!";
        exit;
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Email já cadastrado!');</script>";
        exit;
    }

    // Insere o novo usuário
    $stmt = $pdo->prepare("INSERT INTO users (name, email, cpf, password, dob, address, telephone) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$name, $email, $cpf, $hashed_password, $dob, $address, $telephone])) {
        // echo "Cadastro realizado com sucesso!";
        echo "<script>
        alert('Cadastro realizado com sucesso!');
        window.location.href = '../index.php';
    </script>";
    } else {
        echo "Erro ao cadastrar cliente.";
    }
}

?>

<!DOCTYPE html>
<html>
<script src="../assets/js/password.js"></script>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/c8e307d42e.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="../assets/img/icon.png">
    <title>Cadastro - My Vaccine</title>
</head>

<body class="overflow-x-hidden 2xl:h-screen">

    <nav class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D] relative">
    <a href="../index.php"><img src="../assets/img/logo.png" alt="logo" class="md:hidden w-[190px]" /></a>


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
                    <a href="./vaccines-history.php" class="cursor-pointer hover:font-semibold">histórico de vacinas</a>
                    </li>
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
            class="hidden absolute top-[8vh] right-0 w-2/3 rounded-br-lg rounded-bl-lg bg-white shadow-md md:hidden flex flex-col items-center p-4">
            <ul class="flex flex-col items-center gap-4 text-[14px]">
                <li class="cursor-pointer hover:font-semibold"><a href="../index.php">Home</a></li>
                <li class="cursor-pointer hover:font-semibold"><a href="./posts.php">Postos de Vacinação</a>
                </li>
                <li class="cursor-pointer hover:font-semibold"><a href="./history-vaccine.php">Histórico de
                        vacinação</a></li>
            </ul>
            <div class="mt-6 mb-3">
                <?php if(isset($_SESSION['cpf'])): ?>
                <a href="../routes/logout.php"
                    class="bg-red-500 text-white px-4 py-2 text-sm rounded-md hover:bg-red-600 cursor-pointer">
                    Sair
                </a>
                <?php else: ?>
                <a href="./login.php"
                    class="bg-blue-500 text-white px-4 py-2 text-sm rounded-md hover:bg-blue-600 cursor-pointer">
                    Login
                </a>
                <?php endif; ?>
            </div>

        </div>

    </nav>

    <div class="w-full h-full flex h-[92%] justify-center">
        <!-- left login -->
        <section class="flex md:justify-center md:items-center w-full lg:w-1/2 h-[92vh]">
            <form method="POST"
                class="text-[12px] 2xl:text-base flex flex-col gap-2 2xl:gap-3 px-6 lg:px-[32px] w-full lg:w-4/6 pt-[3rem] md:pt-[0] md:justify-center">
                <h1 class="text-xl 2xl:text-2xl font-semibold">Cadastro</h1>

                <!-- Nome Completo -->
                <div class="flex flex-col gap-2">
                    <label for="name">Nome Completo:</label>
                    <input type="text" name="name" id="name" class="border-2 p-2 2xl:p-3 rounded-lg"
                        placeholder="Digite seu nome completo" required />
                </div>

                <!-- Email -->
                <div class="flex flex-col gap-2">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="border-2 p-2 2xl:p-3 rounded-lg"
                        placeholder="Digite seu email" required />
                </div>

                <div class="flex gap-1 2xl:gap-3 w-full">
                    <!-- CPF -->
                    <div class="flex flex-col gap-2 w-1/2">
                        <label for="cpf">CPF:</label>
                        <input type="text" name="cpf" id="cpf" maxlength="14" class="border-2 p-2 2xl:p-3 rounded-lg"
                            placeholder="Digite seu CPF" oninput="formatCPF(this)" required />
                    </div>

                    <!-- Telefone -->
                    <div class="flex flex-col gap-2 w-1/2">
                        <label for="telephone">Telefone:</label>
                        <input type="text" name="telephone" maxlength="11" id="telephone"
                            class="border-2 p-2 2xl:p-3 rounded-lg" placeholder="(00) 00000-0000" required
                            maxlength="15" oninput="formatPhone(this)" />
                    </div>
                </div>

                <!-- Data de Nascimento -->
                <div class="flex flex-col gap-2">
                    <label for="dob">Data de Nascimento:</label>
                    <input type="date" name="dob" id="dob" class="border-2 p-2 2xl:p-3 rounded-lg" required />
                </div>

                <!-- Endereço -->
                <div class="flex flex-col gap-2">
                    <label for="address">Endereço:</label>
                    <input type="text" name="address" id="address" class="border-2 p-2 2xl:p-3 rounded-lg"
                        placeholder="Digite seu endereço" required />
                </div>

                <!-- Senha -->
                <div class="flex flex-col gap-2 relative">
                     <label for="password">Senha:</label>
                     <input type="password" name="password" id="password" class="border-2 p-2 pr-10 2xl:p-3 rounded-lg" 
                     placeholder="Digite sua senha" required />
                     <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute right-3 top-12 text-gray-600">
                     <i id="eyeIcon1" class="fa-solid fa-eye-slash"></i>
                     </button>
                </div>

                <!-- Confirmar Senha -->
                <div class="flex flex-col gap-2 relative">
                     <label for="password">Confirmar Senha:</label>
                     <input type="password" name="password" id="password" class="border-2 p-2 pr-10 2xl:p-3 rounded-lg" 
                     placeholder="Digite sua senha" required />
                     <button type="button" onclick="togglePassword('password', 'eyeIcon1')" class="absolute right-3 top-12 text-gray-600">
                     <i id="eyeIcon1" class="fa-solid fa-eye-slash"></i>
                     </button>
                </div>

                <!-- Botões -->
                <div class="flex w-full text-xs md:text-base text-center sm:text-start mt-5">
                    <button type="submit"
                        class="bg-[#0B5FFF] text-[12px] 2xl:text-base text-white font-semibold py-2 px-8 2xl:py-4 2xl:px-10 rounded-lg hover:bg-[#074DD2] cursor-pointer">
                        Cadastrar
                    </button>
                </div>
            </form>
        </section>


        <!-- right login -->
        <div class="flex lg:w-1/2 hidden lg:block bg-gradient-to-r from-blue-950 to-blue-900"></div>
    </div>

    <script src="../assets//script/script.js"></script>
    <script>
    function toggleMenu() {
        document.getElementById('mobileMenu').classList.toggle('hidden');
    }
    </script>
</body>

</html>