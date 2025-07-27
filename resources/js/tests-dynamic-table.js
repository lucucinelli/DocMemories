console.log("Tests Dynamic Table Script Loaded");
let rowIndex = 1;

window.newTestRow = function() {
    const tbody = document.getElementById('dynamic-table-tests');
    const newRow = document.createElement('tr');
    const test_date = document.getElementById('test_date').value;
    const test_type = document.getElementById('test_type').value;
    const test_result = document.getElementById('test_result').value;
    const test_note = document.getElementById('test_note').value;
    newRow.className = "bg-gray-300 border-b dark:bg-gray-600 dark:border-gray-700 border-gray-200";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-700">
            <p name="righe[${rowIndex}][test_date]">${test_date}</p>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <p  name="righe[${rowIndex}][test_type]">${test_type}</p>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <p  name="righe[${rowIndex}][test_result]">${test_result}</p>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <p  name="righe[${rowIndex}][test_note]">${test_note}</p>
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
    document.getElementById('test_date').value;
    document.getElementById('test_type').value = "";
    document.getElementById('test_result').value = "";
    document.getElementById('test_note').value = "";
    document.getElementById('modTests').dispatchEvent(new CustomEvent('close', { bubbles: true }));
}

window.deleteRow = function(button) {
    button.closest('tr').remove();
}

