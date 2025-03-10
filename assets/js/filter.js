document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const rows = document.querySelectorAll("table tbody tr");

    searchInput.addEventListener("input", function () {
        const searchValue = searchInput.value.trim().toLowerCase();

        let foundResults = false;

        rows.forEach(row => {
            const stateCell = row.cells[1]; // Acessa a 4ª coluna (estado)
            
            if (stateCell) {
                const stateText = stateCell.textContent.trim().toLowerCase();

                if (stateText.includes(searchValue)) {
                    row.style.display = ""; // Exibe a linha
                    foundResults = true;
                } else {
                    row.style.display = "none"; // Oculta a linha
                }
            }
        });

        // Exibe ou esconde a linha de "Nenhum posto encontrado!"
        const noResultsRow = document.querySelector(".no-results");
        if (!foundResults) {
            if (!noResultsRow) {
                const noResults = document.createElement("tr");
                noResults.classList.add("no-results");
                noResults.innerHTML = '<td colspan="5" class="px-4 py-4 text-center text-gray-400">Nenhum posto encontrado!</td>';
                document.querySelector("table tbody").appendChild(noResults);
            }
        } else {
            const noResults = document.querySelector(".no-results");
            if (noResults) {
                noResults.remove(); // Remove a linha de "Nenhum posto encontrado!"
            }
        }
    });
});


