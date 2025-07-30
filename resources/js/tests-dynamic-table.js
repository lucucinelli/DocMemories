console.log("Tests Dynamic Table Script Loaded");

document.getElementById('test-form').addEventListener('submit', function(e) {
            console.log('test-form submit');
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
    const pathSegments = window.location.pathname.split('/'); // URL
    const visit_id = pathSegments[2]; 
    console.log('save test related to the visit with visit_id:', visit_id);
    fetch(`/createTest/${visit_id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            test_date,
            test_type,
            test_result,
            test_note
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
        appendTestRow(data.id, test_date, test_type, test_result, test_note, tbody, newRow);
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
}

function appendTestRow(test_id, test_date, test_type, test_result, test_note, tbody, newRow) {
    newRow.className = "bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:mb-0 mb-6 rounded-lg shadow-md sm:shadow-none";
    newRow.innerHTML = `
        <td class="px-6 py-2 font-medium text-gray-900 dark:text-gray-700 before:content-['Data'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${test_id}][test_date]" type="date" value="${test_date}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Tipo'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${test_id}][test_type]" value="${test_type}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Esito'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${test_id}][test_result]" value="${test_result}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Nota'] before:font-bold before:block sm:before:hidden">
            <textarea name="righe[${test_id}][test_note]" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 rounded-md shadow-sm" rows="2" disabled>${test_note}</textarea>
        </td>
        <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden">
            <button type="button" onclick="editTestRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"><i class="bi bi-pencil"></i></button>
        </td>
        <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
            <button type="button" onclick="deleteTestRow(this)" class="text-red-600 hover:text-red-800 font-bold dark:text-red-300">✕</button>
        </td>
                          
    `;
    tbody.appendChild(newRow);
    document.getElementById('test_date').value = "";
    document.getElementById('test_type').value = "";
    document.getElementById('test_result').value = "";
    document.getElementById('test_note').value = "";
    document.getElementById('modTests').dispatchEvent(new CustomEvent('close', { bubbles: true }));
}




// Function to delete a row
window.deleteTestRow = function(button) {
    const test_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    fetch(`/deleteTest/${test_id}`, {
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
    console.log('save updated test row');
    const new_test_date = button.closest('tr').querySelector('input[name^="righe["][name$="[test_date]"]').value;
    const new_test_type = button.closest('tr').querySelector('input[name^="righe["][name$="[test_type]"]').value;
    const new_test_result = button.closest('tr').querySelector('input[name^="righe["][name$="[test_result]"]').value;
    const new_test_note = button.closest('tr').querySelector('textarea[name^="righe["][name$="[test_note]"]').value;
    const test_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    
    fetch(`/editTest/${test_id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            new_test_date,
            new_test_type,
            new_test_result,
            new_test_note
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

