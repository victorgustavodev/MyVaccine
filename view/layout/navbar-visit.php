<!-- navbar.php -->
<navbar
      class="px-[6%] h-[8vh] flex justify-between items-center shadow-lg navbar"
    >
      <a href="index.php"
        ><img src="../../assets/img/logo.svg" alt="logo" class="w-[190px]"
      /></a>
      <button class="text-xl md:text-2xl" onclick="toggleMenu()">
        <i class="fa-solid fa-bars"></i>
      </button>
    </navbar>

    <!-- Menu -->
    <div
      id="menu"
      class="absolute top-[10vh] right-0 h-fit w-full lg:w-fit rounded-lg flex justify-center items-center bg-white shadow-lg p-10 transform translate-x-full opacity-0 transition-all duration-500 ease-in-out"
    >
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
        <li>
          <a
            href="/view/pages/register.php"
            class="px-6 py-2 hover:bg-gray-100 rounded-lg transition-colors"
            >Criar conta</a
          >
        </li>

      </ul>
      <!-- Botão para fechar o menu -->
      <button
        class="absolute top-4 right-4 text-2xl text-gray-700"
        onclick="toggleMenu()"
      >
        <i class="fa-solid fa-x"></i>
      </button>
    </div>
</navbar>
