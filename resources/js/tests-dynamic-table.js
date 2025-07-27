console.log("Tests Dynamic Table Script Loaded");
let rowIndex = 1;

document.getElementById('test-form').addEventListener('submit', function(e) {
            e.preventDefault();
            newTestRow();
            console.log('nessuna richiesta inviata.');
});


function newTestRow() {
    const tbody = document.getElementById('dynamic-table-tests');
    const newRow = document.createElement('tr');
    const test_date = document.getElementById('test_date').value;
    const test_type = document.getElementById('test_type').value;
    const test_result = document.getElementById('test_result').value;
    const test_note = document.getElementById('test_note').value;
   
    newRow.className = "bg-gray-300 border-b dark:bg-gray-600 dark:border-gray-700 border-gray-200";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-700">
            <input name="righe[${rowIndex}][test_date]" type="date" value="${test_date}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <input name="righe[${rowIndex}][test_type]"  value="${test_type}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2" disabled>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <input name="righe[${rowIndex}][test_result]"  value="${test_result}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" disabled>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <textarea name="righe[${rowIndex}][test_note]" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2" disabled>${test_note}</textarea>
        </td>
        <td class=" px-6 py-2 text-center ">
            <button type="button" onclick="editTestRow(this)" class="text-blue-600 hover:text-blue-800 font-bold"> <i class="bi bi-pencil"></i> </button>
        </td>
        <td class=" px-6 py-2 text-center ">
            <button type="button" onclick="deleteTestRow(this)" class="text-red-600 hover:text-red-800 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    rowIndex++;
    document.getElementById('test_date').value= "";
    document.getElementById('test_type').value = "";
    document.getElementById('test_result').value = "";
    document.getElementById('test_note').value = "";
    document.getElementById('modTests').dispatchEvent(new CustomEvent('close', { bubbles: true }));
}

window.deleteTestRow = function(button) {
    button.closest('tr').remove();
}

// Function to edit a row
window.editTestRow = function(button) {
    // Abilita tutti gli input nella riga
    button.closest('tr').querySelectorAll('input').forEach(input => {
        input.disabled = false;
    });
    button.closest('tr').querySelectorAll('textarea').forEach(textarea => {
        textarea.disabled = false;      
    });

    // Cambia l'icona ✎ in ✔
    button.innerHTML = '<i class="bi bi-check  text-2xl"></i>';
    button.classList.remove('text-blue-600', 'hover:text-blue-800');
    button.classList.add('text-green-600', 'hover:text-green-800');

    // Cambia la funzione onclick da editRow a saveRow
    button.setAttribute('onclick', 'saveTestRow(this)');
}

// Function to save the edited row
window.saveTestRow = function(button) {
    // Disabilita tutti gli input nella riga
    button.closest('tr').querySelectorAll('input').forEach(input => {
        input.disabled = true;
    });
    button.closest('tr').querySelectorAll('textarea').forEach(textarea => {
        textarea.disabled = true;      
    });

    // Ripristina l'icona ✔ in ✎
    button.innerHTML = '<i class="bi bi-pencil"></i>';
    button.classList.remove('text-green-600', 'hover:text-green-800');
    button.classList.add('text-blue-600', 'hover:text-blue-800');

    // Cambia di nuovo onclick da saveRow a editRow
    button.setAttribute('onclick', 'editTestRow(this)');
}

