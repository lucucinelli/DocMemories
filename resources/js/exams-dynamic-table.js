console.log("Exams Dynamic Table Script Loaded");
let rowIndex = 1;

window.newExamRow = function() {
    const tbody = document.getElementById('dynamic-table-exams');
    const newRow = document.createElement('tr');
    const exam_date = document.getElementById('exam_date').value;
    const exam_type = document.getElementById('exam_type').value;
    const exam_result = document.getElementById('exam_result').value;
    const exam_note = document.getElementById('exam_note').value;
    newRow.className = "bg-gray-300 border-b dark:bg-gray-600 dark:border-gray-700 border-gray-200";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-700">
            <p name="righe[${rowIndex}][date]">${exam_date}</p>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <p  name="righe[${rowIndex}][type]">${exam_type}</p>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <p  name="righe[${rowIndex}][result]">${exam_result}</p>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <p  name="righe[${rowIndex}][note]">${exam_note}</p>
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
    document.getElementById('exam_date').value = "";
    document.getElementById('exam_type').value = "";
    document.getElementById('exam_result').value = "";
    document.getElementById('exam_note').value = "";
    document.getElementById('modExams').dispatchEvent(new CustomEvent('close', { bubbles: true }));
}

window.deleteRow = function(button) {
    button.closest('tr').remove();
}

