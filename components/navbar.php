<!-- navbar.php -->
<navbar
      class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar text-[#100E3D]"
    >
      <a href="../../public/index.php"
        ><img src="../../assets/img/logo.png" alt="logo" class="w-[190px]"
      /></a>
      <!-- <button class="text-xl md:text-2xl" onclick="toggleMenu()">
        <i class="fa-solid fa-bars"></i>
      </button> -->
      <div class="flex gap-[64px] text-[16px]">
        <ul class="flex gap-4 transition-all duration-500 ease-in-out">
          <li><a href="../../public/index.php" class="hover:underline">Home</a></li>
          <li><a href="../pages/dependentes.php" class="hover:underline">Dependentes</a></li>
          <li><a href="../pages/postos.php" class="hover:underline">Posto de saúde</a></li>
        </ul>
        <a href="" class="font-bold hover:text-">Login</a>
        </div>
      </navbar>

    <!-- Menu -->
    <div id="menu" class="absolute top-[10vh] right-0 h-fit w-full lg:w-fit rounded-lg flex justify-center items-center bg-white shadow-lg p-10 transform translate-x-full opacity-0 transition-all duration-500 ease-in-out">
      <ul class="flex flex-col items-center space-y-4 text-lg font-semibold">
        <li>
          <a
            href="index.php"
            class="px-6 py-2 hover:bg-gray-100 rounded-lg transition-colors"
            >Home</a
          >
        </li>
        <li>
          <a
            href="/view/pages/login.php"
            class="px-6 py-2 hover:bg-gray-100 rounded-lg transition-colors"
            >Fazer login</a
          >
        </li>

      </ul>
      <!-- Botão para fechar o menu -->
      <!-- <button
        class="absolute top-4 right-4 text-2xl text-gray-700"
        onclick=""
      >
        <i class="fa-solid fa-x"></i>
      </button> -->
    </div>
</navbar>