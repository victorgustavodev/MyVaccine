
document.getElementById("openModal").addEventListener("click", function () {
    document.getElementById("modal").classList.remove("hidden");
});

document.getElementById("closeModal").addEventListener("click", function () {
    document.getElementById("modal").classList.add("hidden");
});

document.getElementById("vaccineForm").addEventListener("submit", function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("create-vaccine.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Vacina cadastrada com sucesso!");
            location.reload(); // Recarrega a página para atualizar a lista
        } else {
            alert("Erro ao cadastrar vacina!");
        }
    })
    .catch(error => console.error("Erro:", error));
});