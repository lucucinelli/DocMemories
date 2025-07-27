console.log("Exams Dynamic Table Script Loaded");
let rowIndex = 1;

document.getElementById('exam-form').addEventListener('submit', function(e) {
            e.preventDefault();
            newExamRow();
            console.log('nessuna richiesta inviata.');
});

function newExamRow() {
    const tbody = document.getElementById('dynamic-table-exams');
    const newRow = document.createElement('tr');
    const exam_date = document.getElementById('exam_date').value;
    const exam_type = document.getElementById('exam_type').value;
    const exam_result = document.getElementById('exam_result').value;
    const exam_note = document.getElementById('exam_note').value;
    newRow.className = "bg-gray-300 border-b dark:bg-gray-600 dark:border-gray-700 border-gray-200";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-700">
            <input name="righe[${rowIndex}][date]" type="date" value="${exam_date}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <input name="righe[${rowIndex}][type]" value="${exam_type}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <input name="righe[${rowIndex}][result]" value="${exam_result}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <textarea name="righe[${rowIndex}][note]" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>${exam_note}</textarea>
        </td>
        <td class=" px-6 py-2 text-center ">
            <button type="button" onclick="editExamRow(this)" class="text-blue-600 hover:text-blue-800 font-bold"> <i class="bi bi-pencil"></i> </button>
        </td>
        <td class=" px-6 py-2 text-center ">
            <button type="button" onclick="deleteExamRow(this)" class="text-red-600 hover:text-red-800 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    rowIndex++;
    document.getElementById('exam_date').value = "";
    document.getElementById('exam_type').value = "";
    document.getElementById('exam_result').value = "";
    document.getElementById('exam_note').value = "";
    document.getElementById('modExams').dispatchEvent(new CustomEvent('close', { bubbles: true }));
}

window.deleteExamRow = function(button) {
    button.closest('tr').remove();
}

// Function to edit a row
window.editExamRow = function(button) {
    // Abilita tutti gli input nella riga
    button.closest('tr').querySelectorAll('input').forEach(input => {
        input.disabled = false;
    });
    button.closest('tr').querySelectorAll('textarea').forEach(textarea => {
        textarea.disabled = false;      
    });

    // Cambia l'icona ✎ in ✔
    button.innerHTML = '<i class="bi bi-check text-2xl"></i>';
    button.classList.remove('text-blue-600', 'hover:text-blue-800');
    button.classList.add('text-green-600', 'hover:text-green-800');

    // Cambia la funzione onclick da editRow a saveRow
    button.setAttribute('onclick', 'saveExamRow(this)');
}

// Function to save the edited row
window.saveExamRow = function(button) {
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

    // Cambia di nuovo onclick da saveExamRow a editExamRow
    button.setAttribute('onclick', 'editExamRow(this)');
}
