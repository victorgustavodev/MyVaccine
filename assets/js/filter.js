document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("searchInput");
    const tableRows = document.querySelectorAll("tbody tr");
    const tbody = document.querySelector("tbody");
    
    const noResultsRow = document.createElement("tr");
    noResultsRow.innerHTML = '<td colspan="6" class="px-4 py-4 text-center text-gray-400">Nenhum posto encontrado!</td>';
    noResultsRow.style.display = "none";
    tbody.appendChild(noResultsRow);

    searchInput.addEventListener("input", function () {
        const searchValue = searchInput.value.trim().toLowerCase();
        let hasResults = false;

        tableRows.forEach(row => {
            const stateColumn = row.querySelector("td:nth-child(4)");
            if (stateColumn) {
                const stateText = stateColumn.textContent.trim().toLowerCase();
                const matches = stateText.includes(searchValue);
                row.style.display = matches ? "" : "none";
                if (matches) hasResults = true;
            }
        });

        noResultsRow.style.display = hasResults ? "none" : "";
    });
});
