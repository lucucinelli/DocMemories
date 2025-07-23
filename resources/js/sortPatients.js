function compareText(a, b, ascending = true) {
    const valA = a.toLowerCase();
    const valB = b.toLowerCase();
    return ascending ? valA.localeCompare(valB) : valB.localeCompare(valA);
}

function compareDates(a, b, ascending = true) {
    const dateA = new Date(a.split('/').reverse().join('-'));
    const dateB = new Date(b.split('/').reverse().join('-'));
    return ascending ? dateA - dateB : dateB - dateA;
}

export function enableTableSorting() {
    let sortDirection = {}; // key: columnIndex, value: ascending boolean

    document.querySelectorAll("th[data-sort]").forEach((th) => {
        th.addEventListener("click", () => {
            const table = th.closest("table");
            const tbody = table.querySelector("tbody");
            const rows = Array.from(tbody.querySelectorAll("tr"));
            const columnIndex = parseInt(th.dataset.index);
            const sortType = th.dataset.sort;

            // Toggle sorting direction
            const ascending = !(sortDirection[columnIndex] ?? false);
            sortDirection[columnIndex] = ascending;

            rows.sort((rowA, rowB) => {
                const textA = rowA.children[columnIndex].innerText.trim();
                const textB = rowB.children[columnIndex].innerText.trim();
                return sortType === "date"
                    ? compareDates(textA, textB, ascending)
                    : compareText(textA, textB, ascending);
            });

            // Update DOM
            rows.forEach((row) => tbody.appendChild(row));
        });
    });
}
