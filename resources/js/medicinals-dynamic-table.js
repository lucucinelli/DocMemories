let rowIndex = 1;

window.newRow = function() {
    const tbody = document.getElementById('tabella-dinamica');
    const newRow = document.createElement('tr');
    const med_name = document.getElementById('medicinal_name').value;
    const med_quantity = document.getElementById('medicinal_quantity').value;
    const med_usage = document.getElementById('medicinal_usage').value;
    const med_period = document.getElementById('medicinal_period').value;
    newRow.className = "bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            <p name="righe[${rowIndex}][name]">${med_name}</p>
        </td>
        <td class="px-6 py-4">
            <p  name="righe[${rowIndex}][quantity]">${med_quantity}</p>
        </td>
        <td class="px-6 py-4">
            <p  name="righe[${rowIndex}][usage]">${med_usage}</p>
        </td>
        <td class="px-6 py-4">
            <p  name="righe[${rowIndex}][period]">${med_period}</p>
        </td>
        <td class="px-6 py-2 text-center">
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