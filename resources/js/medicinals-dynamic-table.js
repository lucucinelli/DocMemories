console.log("Medicinals Dynamic Table Script Loaded");
let rowIndex = 1;

document.getElementById('medicinal-form').addEventListener('submit', function(e) {
            e.preventDefault();
            newMedicinalRow();
            console.log('nessuna richiesta inviata.');
});

function newMedicinalRow() {
    const tbody = document.getElementById('dynamic-table-medicinals');
    const newRow = document.createElement('tr');
    const med_name = document.getElementById('medicinal_name').value;
    const med_quantity = document.getElementById('medicinal_quantity').value;
    const med_usage = document.getElementById('medicinal_usage').value;
    const med_period = document.getElementById('medicinal_period').value;
    newRow.className = "bg-gray-300 border-b dark:bg-gray-600 dark:border-gray-700 border-gray-200";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-700">
            <p name="righe[${rowIndex}][name]">${med_name}</p>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <p  name="righe[${rowIndex}][quantity]">${med_quantity}</p>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <p  name="righe[${rowIndex}][usage]">${med_usage}</p>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <p  name="righe[${rowIndex}][period]">${med_period}</p>
        </td>
        <td class=" px-6 py-2 text-center ">
            <button type="button" onclick="editRow(this)" class="text-blue-600 hover:text-blue-800 font-bold"> ✎ </button>
        </td>
        <td class=" px-6 py-2 text-center ">
            <button type="button" onclick="deleteRow(this)" class="text-red-600 hover:text-red-800 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    rowIndex++;
    document.getElementById('medicinal_name').value = "";
    document.getElementById('medicinal_quantity').value = "";
    document.getElementById('medicinal_usage').value = "";
    document.getElementById('medicinal_period').value = "";
    document.getElementById('modMedicinals').dispatchEvent(new CustomEvent('close', { bubbles: true }));
}

window.deleteRow = function(button) {
    button.closest('tr').remove();
}


