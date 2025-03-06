
document.getElementById("openModal").addEventListener("click", function () {
    document.getElementById("modal").classList.remove("hidden");
});

document.getElementById("closeModal").addEventListener("click", function () {
    document.getElementById("modal").classList.add("hidden");
});

document.getElementById("stockForm").addEventListener("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("create-stock.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Estoque cadastrado com sucesso!");
            location.reload(); // Recarrega a página para atualizar a lista
        } else {
            alert("Erro ao cadastrar Estoque!");
        }
    })
    .catch(error => console.error("Erro:", error));
});

