console.log("Exams Dynamic Table Script Loaded");


document.getElementById('exam-form').addEventListener('submit', function(e) {
            console.log('exam-form submit');    
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
    const exam_file = document.getElementById('exam_file') ? document.getElementById('exam_file').files[0] : null;

    const pathSegments = window.location.pathname.split('/');
    const visit_id = pathSegments[2]; 

    let formData = new FormData();
    formData.append('exam_date', exam_date);
    formData.append('exam_type', exam_type);
    formData.append('exam_result', exam_result);
    formData.append('exam_note', exam_note);
    if (exam_file) {
        formData.append('exam_file', exam_file);
    }

    fetch(`/createExam/${visit_id}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) throw new Error('Request error');
        return response.json();
    })
    .then(data => {
        appendExamRow(data.id, exam_date, exam_type, exam_result, exam_note, tbody, newRow, data.has_file);
        document.getElementById('exam_file').value = '';
    })
    .catch(error => console.error('Error:', error));
}




function appendExamRow(exam_id, exam_date, exam_type, exam_result, exam_note, tbody, newRow, has_file) {
    newRow.className = "bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:mb-0 mb-1 rounded-lg shadow-md sm:shadow-none";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-2 font-medium text-gray-600 dark:text-gray-900 before:content-['Nome'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${exam_id}][exam_date]" type="date" value="${exam_date}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Tipo'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${exam_id}][exam_type]"  value="${exam_type}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" rows="2" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Esito'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${exam_id}][exam_result]"  value="${exam_result}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full resize-none" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Nota'] before:font-bold before:block sm:before:hidden">
            <textarea name="righe[${exam_id}][exam_note]" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" rows="2" disabled>${exam_note}</textarea>
        </td>
        <td class="px-6 py-2 text-center before:content-['File'] before:font-bold before:block sm:before:hidden">
            ${has_file 
                ? `<a href="/viewExamFile/${exam_id}" target="_blank" class="text-white hover:underline"><i class="bi bi-file-earmark-arrow-down-fill"></i></a>
                   <button type="button" onclick="replaceExamFile(${exam_id})" class="ml-2 text-blue-600"><i class="bi bi-arrow-repeat"></i></button>
                   <button type="button" onclick="deleteExamFile(${exam_id})" class="ml-2 text-red-600"><i class="bi bi-trash3"></i></button>`
                : `<button type="button" onclick="uploadExamFile(${exam_id})" class="text-gray-600 dark:text-gray-300"><i class="bi bi-paperclip"></i></button>`
            }
        </td>
        <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden">
            <button type="button" onclick="editExamRow(this)" class="text-blue-600 hover:text-blue-800 dark:text-blue-300 font-bold"> <i class="bi bi-pencil"></i> </button>
        </td>
        <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
            <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'confirm-exam-deletion')" onclick="openDeleteExamModal(this)" class="text-red-600 hover:text-red-800 dark:text-red-300 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    document.getElementById('exam_date').value = "";
    document.getElementById('exam_type').value = "";
    document.getElementById('exam_result').value = "";
    document.getElementById('exam_note').value = "";
    document.getElementById('modExams').dispatchEvent(new CustomEvent('close', { bubbles: true }));
}

window.openDeleteExamModal = function(button) {
    const exam_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    document.getElementById('exam_id').value = exam_id;
}

// Function to delete a row
window.deleteExamRow = function() {
    const exam_id = document.getElementById('exam_id').value
    fetch(`/deleteExam/${exam_id}`, {
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
    const riga = document.querySelector(`input[name^="righe[${exam_id}]"]`);
    riga.closest('tr').remove();
    document.getElementById('exam_id').value = ""; 
    // Chiudi la modale (dispatch evento Alpine)
    
};


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
    console.log('save updated exam row');
    const new_exam_date = button.closest('tr').querySelector('input[name^="righe["][name$="[exam_date]"]').value;
    const new_exam_type = button.closest('tr').querySelector('input[name^="righe["][name$="[exam_type]"]').value;
    const new_exam_result = button.closest('tr').querySelector('input[name^="righe["][name$="[exam_result]"]').value;
    const new_exam_note = button.closest('tr').querySelector('textarea[name^="righe["][name$="[exam_note]"]').value;
    const exam_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];

    fetch(`/editExam/${exam_id}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            new_exam_date,
            new_exam_type,
            new_exam_result,
            new_exam_note
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
    // Disable all inputs in the row
    button.closest('tr').querySelectorAll('input').forEach(input => {
        input.disabled = true;
    });
    button.closest('tr').querySelectorAll('textarea').forEach(textarea => {
        textarea.disabled = true;      
    });

    // Restore the icon ✔ to ✎
    button.innerHTML = '<i class="bi bi-pencil"></i>';
    button.classList.remove('text-green-600', 'hover:text-green-800');
    button.classList.add('text-blue-600', 'hover:text-blue-800');

    // Change onclick back from saveExamRow to editExamRow
    button.setAttribute('onclick', 'editExamRow(this)');
}



// upload file 
window.uploadExamFile = function(exam_id) {
    let input = document.createElement('input');
    input.type = 'file';
    input.accept = '.pdf,.jpg,.jpeg,.png';
    input.onchange = function() {
        let file = input.files[0];
        if (!file) return;
        let formData = new FormData();
        formData.append('exam_file', file);
        fetch(`/uploadExamFile/${exam_id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        }).then(res => {
            if (res.ok) {
                alert('File caricato con successo');
                updateFileCell(exam_id, true);
            } else {
                alert('Errore durante il caricamento del file: file troppo grande');
            }
        });
    };
    input.click();
};

// replace file and delete
window.replaceExamFile = function(exam_id) {
    let input = document.createElement('input');
    input.type = 'file';
    input.accept = '.pdf,.jpg,.jpeg,.png';
    input.onchange = function() {
        let file = input.files[0];
        if (!file) return;
        let formData = new FormData();
        formData.append('exam_file', file);
        fetch(`/replaceExamFile/${exam_id}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        }).then(res => {
            if (res.ok) {
                alert('File aggiornato con successo');
                updateFileCell(exam_id, true);
            } else {
                alert('Errore durante il caricamento del file: file troppo grande');
            }
        });
    };
    input.click();
};

window.deleteExamFile = function(exam_id) {
    if (!confirm("Vuoi davvero cancellare il file?")) return;
    fetch(`/deleteExamFile/${exam_id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }).then(res => {
        if (res.ok) {
            alert('File eliminato');
            updateFileCell(exam_id, false);
        }
    });
};

// function that updates file's icons into the table according to the operation
function updateFileCell(exam_id, hasFile) {
    const row = document.querySelector(`input[name="righe[${exam_id}][exam_date]"]`).closest('tr');
    const fileCell = row.querySelector('td:nth-child(5)'); // 5ª colonna "File"
    if (!fileCell) return;

    if (hasFile) {
        fileCell.innerHTML = `
            <a href="/viewExamFile/${exam_id}" target="_blank" class="text-white hover:underline"><i class="bi bi-file-earmark-arrow-down-fill"></i></a>
            <button type="button" onclick="replaceExamFile(${exam_id})" class="ml-2 text-blue-600"><i class="bi bi-arrow-repeat"></i></button>
            <button type="button" onclick="deleteExamFile(${exam_id})" class="ml-2 text-red-600"><i class="bi bi-trash3"></i></button>
        `;
    } else {
        fileCell.innerHTML = `<button type="button" onclick="uploadExamFile(${exam_id})" class="text-gray-600 dark:text-gray-300"><i class="bi bi-paperclip"></i></button>`;
    }
}
