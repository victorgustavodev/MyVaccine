// Função de alternar entre menu aberto e fechado
function toggleMenu() {
  const menu = document.getElementById("menu");
  if (menu.classList.contains("translate-x-full")) {
    menu.classList.remove("translate-x-full", "opacity-0");
    menu.classList.add("translate-x-0", "opacity-100");
  } else {
    menu.classList.add("translate-x-full", "opacity-0");
    menu.classList.remove("translate-x-0", "opacity-100");
  }
}

// Fechar o menu quando clicar fora da área
document.addEventListener("click", function (event) {
  const menu = document.getElementById("menu");
  const button = document.querySelector("button");
  if (!menu.contains(event.target) && !button.contains(event.target)) {
    if (!menu.classList.contains("translate-x-full")) {
      menu.classList.add("translate-x-full", "opacity-0");
      menu.classList.remove("translate-x-0", "opacity-100");
    }
  }
});
