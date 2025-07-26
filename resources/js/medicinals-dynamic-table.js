let rowIndex = 1;

window.newRow = function() {
    const tbody = document.getElementById('tabella-dinamica');
    const newRow = document.createElement('tr');
    const med_name = document.getElementById('medicinal_name').value;
    const med_quantity = document.getElementById('medicinal_quantity').value;
    const med_usage = document.getElementById('medicinal_usage').value;
    const med_period = document.getElementById('medicinal_period').value;
    newRow.innerHTML = `
        <td class="border px-4 py-2">
            <h2 name="righe[${rowIndex}][name]">${med_name}</h2>
        </td>
        <td class="border px-4 py-2">
            <h2  name="righe[${rowIndex}][quantity]">${med_quantity}</h2>
        </td>
        <td class="border px-4 py-2">
            <h2  name="righe[${rowIndex}][usage]">${med_usage}</h2>
        </td>
        <td class="border px-4 py-2">
            <h2  name="righe[${rowIndex}][period]">${med_period}</h2>
        </td>
        <td class="border px-4 py-2 text-center">
            <button type="button" onclick="deleteRow(this)" class="text-red-600 hover:text-red-800 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    rowIndex++;
    document.getElementById('medicinal_name').value = "";
    document.getElementById('medicinal_quantity').value = "";
    document.getElementById('medicinal_usage').value = "";
    document.getElementById('medicinal_period').value = "";
    document.getElementById('cancel-button').click(); // Close the modal after adding a new row
}

window.deleteRow = function(button) {
    button.closest('tr').remove();
}