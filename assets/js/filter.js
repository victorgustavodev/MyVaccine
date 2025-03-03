document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const tableRows = document.querySelectorAll("tbody tr");
    const tbody = document.querySelector("tbody");

    // Criar a linha de "Nenhum resultado encontrado", mas sem adicioná-la diretamente
    const noResultsRow = document.createElement("tr");
    noResultsRow.innerHTML = '<td colspan="6" class="px-4 py-4 text-center text-gray-400">Nenhum posto encontrado!</td>';
    noResultsRow.style.display = "none";
    tbody.appendChild(noResultsRow); // Só adicionamos, mas deixamos oculta

    searchInput.addEventListener("input", function () {
        const searchValue = searchInput.value.trim().toLowerCase();
        let hasResults = false;

        tableRows.forEach(row => {
            const stateColumn = row.querySelector("td:nth-child(1)"); // Ajuste conforme necessário
            if (stateColumn) {
                const stateText = stateColumn.textContent.trim().toLowerCase();
                const matches = stateText.includes(searchValue);
                row.style.display = matches ? "" : "none";
                if (matches) hasResults = true;
            }
        });

        // Exibe ou oculta a linha de "Nenhum resultado encontrado"
        noResultsRow.style.display = hasResults ? "none" : "";
    });
});
