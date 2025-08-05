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
    newRow.className = "bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:mb-0 mb-1 rounded-lg shadow-md sm:shadow-none";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-2 font-medium text-gray-600 dark:text-gray-900 before:content-['Nome'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${medicinal_id}][med_name]" value="${med_name}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Quantità'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${medicinal_id}][med_quantity]" value="${med_quantity}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Modalità di assunzione'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${medicinal_id}][med_usage]" value="${med_usage}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Periodo'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${medicinal_id}][med_period]" value="${med_period}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden">
            <button type="button" onclick="editMedicinalRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"> <i class="bi bi-pencil"></i> </button>
        </td>
        <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
            <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'confirm-medicinal-deletion')" onclick="openDeleteMedicinalModal(this)" class="text-red-600 hover:text-red-800 dark:text-red-300 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    document.getElementById('medicinal_name').value = "";
    document.getElementById('medicinal_quantity').value = "";
    document.getElementById('medicinal_usage').value = "";
    document.getElementById('medicinal_period').value = "";
    document.getElementById('modMedicinals').dispatchEvent(new CustomEvent('close', { bubbles: true }));
}

window.openDeleteMedicinalModal = function(button) {
    const medicinal_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    document.getElementById('medicinal_id').value = medicinal_id;
}

// Function to delete a row
window.deleteMedicinalRow = function() {
    const medicinal_id = document.getElementById('medicinal_id').value
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
    const riga = document.querySelector(`input[name^="righe[${medicinal_id}]"]`);
    riga.closest('tr').remove();
    document.getElementById('medicinal_id').value = ""; 
    // Chiudi la modale (dispatch evento Alpine)
    
};


// Function to edit a row
window.editMedicinalRow = function(button) {
    // Enable all inputs in the row
    button.closest('tr').querySelectorAll('input').forEach(input => {
        input.disabled = false;
    });

    // Change the icon ✎ in ✔
    button.innerHTML = '<i class="bi bi-check text-2xl"></i>';
    button.classList.remove('text-blue-600', 'hover:text-blue-800');
    button.classList.add('text-green-600', 'hover:text-green-800');

    // Change the onclick function from editRow to saveRow
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



