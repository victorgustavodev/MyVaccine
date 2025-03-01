// Recarregar página

function reloadPage() {
    window.location.reload();
}

// FUNÇÃO DELETAR POSTO
function excluirPost(id) {
    if (confirm("Todos os dados vinculados a ele serão apagados. Deseja cotinuar?")) {
        fetch(`delete-post.php?id=${id}`, { method: 'GET' })
        .then(response => response.text())
        .then(data => {
            alert("Post excluído com sucesso!");
            location.reload(); // Atualiza a página sem redirecionar
        })
        .catch(error => console.error('Erro ao excluir:', error));
    }
}

// CRIAR POSTO 
    document.getElementById("openModalPost").addEventListener("click", function () {
        document.getElementById("modal").classList.remove("hidden");
    });

    document.getElementById("closeModalPost").addEventListener("click", function () {
        document.getElementById("modal").classList.add("hidden");
    });

    // AJAX para criar posto sem recarregar a página
    document.getElementById("createPostForm").addEventListener("submit", function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch("../posts/create-post.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Posto cadastrado com sucesso!");
                location.reload();
            } else {
                alert("Erro ao cadastrar posto.");
            }
        })
        .catch(error => console.error("Erro:", error));
    });

// EDITAR POSTO

function openEditModal(postId) {
    fetch(`../posts/get-post.php?id=${postId}`)
        .then(response => response.json())
        .then(post => {
            if (post.success) {
                document.getElementById("editPostId").value = post.data.id;
                document.getElementById("editPostName").value = post.data.name;
                document.getElementById("editPostAddress").value = post.data.address;
                document.getElementById("editPostCity").value = post.data.city;
                document.getElementById("editPostState").value = post.data.state;
                document.getElementById("editModal").classList.remove("hidden");
            } else {
                alert("Erro ao buscar os dados do posto.");
            }
        })
        .catch(error => console.error("Erro ao buscar posto:", error));
}

document.getElementById("editPostForm").addEventListener("submit", function (event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch("../posts/update-post.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Posto atualizado com sucesso!");
            location.reload();
        } else {
            alert("Erro ao atualizar posto: " + data.message);
        }
    })
    .catch(error => console.error("Erro ao atualizar posto:", error));
});

