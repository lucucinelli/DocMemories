console.log("Medicinals Dynamic Table Script Loaded");

document.getElementById('medicinal-form').addEventListener('submit', function(e) {
            e.preventDefault();
            newMedicinalRow();
            console.log('nessuna richiesta inviata.');
});
// Function to add a new medicinal row and db
function newMedicinalRow() {
    const tbody = document.getElementById('dynamic-table-medicinals');
    const newRow = document.createElement('tr');
    const med_name = document.getElementById('medicinal_name').value;
    const med_quantity = document.getElementById('medicinal_quantity').value;
    const med_usage = document.getElementById('medicinal_usage').value;
    const med_period = document.getElementById('medicinal_period').value;
    const pathSegments = window.location.pathname.split('/'); // URL
    const visit_id = pathSegments[2]; 
    fetch(`/createMedicinal/${visit_id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            med_name,
            med_quantity,
            med_usage,
            med_period
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Request error');
        }
        return response.json();
    })
    .then(data => {
        console.log('Server response:', data);
        // Only if the response is ok, then add the row to the table:
        appendMedicinalRow(data.id, med_name, med_quantity, med_usage, med_period, tbody, newRow);
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
}

function appendMedicinalRow(medicinal_id, med_name, med_quantity, med_usage, med_period, tbody, newRow) {
    newRow.className = "bg-gray-300 border-b dark:bg-gray-600 dark:border-gray-700 border-gray-200";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-gray-700">
            <input name="righe[${medicinal_id}][med_name]" value="${med_name}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <input name="righe[${medicinal_id}][med_quantity]" value="${med_quantity}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <input name="righe[${medicinal_id}][med_usage]" value="${med_usage}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-4 dark:text-gray-500">
            <input name="righe[${medicinal_id}][med_period]" value="${med_period}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class=" px-6 py-2 text-center ">
            <button type="button" onclick="editMedicinalRow(this)" class="text-blue-600 hover:text-blue-800 font-bold"> <i class="bi bi-pencil"></i> </button>
        </td>
        <td class=" px-6 py-2 text-center ">
            <button type="button" onclick="deleteMedicinalRow(this)" class="text-red-600 hover:text-red-800 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    document.getElementById('medicinal_name').value = "";
    document.getElementById('medicinal_quantity').value = "";
    document.getElementById('medicinal_usage').value = "";
    document.getElementById('medicinal_period').value = "";
    document.getElementById('modMedicinals').dispatchEvent(new CustomEvent('close', { bubbles: true }));
}


// Function to delete a row
window.deleteMedicinalRow = function(button) {
    console.log('delete medicinal row');
    const medicinal_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    fetch(`/deleteMedicinal/${medicinal_id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Request error');
        }
        return response.ok;
    })
    button.closest('tr').remove();
}

// Function to edit a row
window.editMedicinalRow = function(button) {
    // Abilita tutti gli input nella riga
    button.closest('tr').querySelectorAll('input').forEach(input => {
        input.disabled = false;
    });

    // Cambia l'icona ✎ in ✔
    button.innerHTML = '<i class="bi bi-check text-2xl"></i>';
    button.classList.remove('text-blue-600', 'hover:text-blue-800');
    button.classList.add('text-green-600', 'hover:text-green-800');

    // Cambia la funzione onclick da editRow a saveRow
    button.setAttribute('onclick', 'saveMedicinalRow(this)');
}

// Function to save the edited row
window.saveMedicinalRow = function(button) {
    console.log('save updated medicinal row');
    const new_med_name = button.closest('tr').querySelector('input[name^="righe["][name$="[med_name]"]').value;
    const new_med_quantity = button.closest('tr').querySelector('input[name^="righe["][name$="[med_quantity]"]').value;
    const new_med_usage = button.closest('tr').querySelector('input[name^="righe["][name$="[med_usage]"]').value;
    const new_med_period = button.closest('tr').querySelector('input[name^="righe["][name$="[med_period]"]').value;
    const medicinal_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];

    fetch(`/editMedicinal/${medicinal_id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            new_med_name,
            new_med_quantity,
            new_med_usage,
            new_med_period
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Request error');
        }
        return response.json();
    })
    .then(data => {
        console.log('Server response:', data);
    })
    .catch(error => {
        console.error('Error:', error);
    });
    // Disabilita tutti gli input nella riga
    button.closest('tr').querySelectorAll('input').forEach(input => {
        input.disabled = true;
    });

    // Ripristina l'icona ✔ in ✎
    button.innerHTML = '<i class="bi bi-pencil"></i>';
    button.classList.remove('text-green-600', 'hover:text-green-800');
    button.classList.add('text-blue-600', 'hover:text-blue-800');

    // Cambia di nuovo onclick da saveMedicinalRow a editMedicinalRow
    button.setAttribute('onclick', 'editMedicinalRow(this)');
}



