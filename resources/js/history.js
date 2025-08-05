//---------------------------------------generic------------------------------------------------
console.log("Generic Script Loaded");

const tabs = document.querySelectorAll(".tab-btn");
const contents = document.querySelectorAll(".contenuto");

function showTab(tabName) {
    contents.forEach(c => c.classList.add("hidden"));
    document.querySelector(`[data-content="${tabName}"]`).classList.remove("hidden");

    tabs.forEach(t => {
        t.classList.remove("bg-red-600", "text-white", "font-semibold");
        t.classList.add("bg-white", "text-gray-700");
    });

    const activeTab = document.querySelector(`[data-tab="${tabName}"]`);
    activeTab.classList.remove("bg-white", "text-gray-700");
    activeTab.classList.add("bg-red-600", "text-white", "font-semibold");

    //Salva il nome della tab selezionata
    localStorage.setItem("activeTab", tabName);
}

//Recupera la tab attiva salvata oppure default
const savedTab = localStorage.getItem("activeTab") || "physiological";
showTab(savedTab);

tabs.forEach(tab => {
    tab.addEventListener("click", () => {
        const tabName = tab.getAttribute("data-tab");
        showTab(tabName);
    });
});

window.deleteRow = function(){
    const history_id = document.getElementById('history_id').value;
    const history_type = document.getElementById('history_type').value;
    switch (history_type) {
        case "remote":
            // Call the delete function for remote history
            deleteRemoteRow(history_id);
            break;
        case "next":
            // Call the delete function for next history
            deleteNextRow(history_id);
            break;
        default:
            deleteFamiliarRow(history_id);
    }
    document.getElementById('history_type').value = ""; // Reset the history_type after deletion
};

//-------------------------------------physiological history----------------------------------
console.log("Physiological History Script Loaded");


document.addEventListener('DOMContentLoaded', function() {
    const physiologicalHistoryForm = document.getElementById('physiological-history-form');
    const formFields = physiologicalHistoryForm ? physiologicalHistoryForm.querySelectorAll('input, select') : [];
    const editButton = document.getElementById('edit-button');
    const cancelButton = document.getElementById('cancel-button');
    const saveButton = document.getElementById('save-button');
    const pathSegments = window.location.pathname.split('/');
    const patient_id = pathSegments[2];

    fetch(`/isPhysiologicalHistorySet/${patient_id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Request error');
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Se la storia esiste, metti i campi in modalità di sola lettura
            formFields.forEach(field => {
                if (field.type === 'input') {
                    field.readOnly = true; 
                } else {
                    field.disabled = true; // Per i campi select
                }
            });
        } else {
            // Se la storia non esiste, abilita i campi per la creazione
            formFields.forEach(field => {
                if (field.type === 'input') {
                    field.readOnly = false; 
                } else {
                    field.disabled = false; // Per i campi select
                }
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });


    window.toggleEditMode = function() {
        if (editButton && editButton.classList.contains('hidden')) { 

            formFields.forEach(field => {
                if (field.type === 'input') {
                    field.readOnly = true; 
                } else {
                    field.disabled = true; // Per i campi select
                }
            });
            editButton.classList.remove('hidden');
            cancelButton.classList.add('hidden');
            saveButton.classList.add('hidden');
        } else { // Stiamo attivando la modalità di modifica (da 'Modifica')
            formFields.forEach(field => {
                if (field.type === 'input') {
                    field.readOnly = false; 
                } else {
                    field.disabled = false; // Per i campi select
                }
            });
            editButton.classList.add('hidden');
            cancelButton.classList.remove('hidden');
            saveButton.classList.remove('hidden');
        }
    };

    
});

window.savePhysiologicalHistoryUpdated = function() {
    const physiologicalHistoryForm = document.getElementById('physiological-history-form');
    const formFields = physiologicalHistoryForm ? physiologicalHistoryForm.querySelectorAll('input, select') : [];
    const birth = document.getElementById('birth').value;
    const atopy = document.getElementById('atopy').value;
    const nursing = document.getElementById('nursing').value;
    const diet = document.getElementById('diet').value;
    const habits = document.getElementById('habits').value;
    const gender = document.getElementById('gender').value;
    if (gender === 'F') {
        const period = document.getElementById('period').value;
        const period_regularity = document.getElementById('period_regularity').value;
    } else {
        var period = "";
        var period_regularity = "";
    }
    const editButton = document.getElementById('edit-button');
    const cancelButton = document.getElementById('cancel-button');
    const saveButton = document.getElementById('save-button');
    const pathSegments = window.location.pathname.split('/'); 
    const patient_id = pathSegments[2];

    fetch(`/editPhysiologicalHistory/${patient_id}`, {
        method: 'PUT',
        body: JSON.stringify({
            birth,
            atopy,
            nursing,
            diet,
            habits,
            period,
            period_regularity
        }),
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Request error');
        }
        return response.json();
    })
    .then(data => {
        console.log('Server response:', data);
        formFields.forEach(field => {
            if (field.type === 'input') {
                    field.readOnly = true; 
            } else {
                field.disabled = true; // Per i campi select
            }
        });
        editButton.classList.remove('hidden');
        cancelButton.classList.add('hidden');
        saveButton.classList.add('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
    });
}



//-------------------------------------familiar history----------------------------------
console.log("Familiar History Script Loaded");

document.getElementById('familiar-history-form').addEventListener('submit', function(e) {
    e.preventDefault();
    newFamiliarHistoryRow();
});

function newFamiliarHistoryRow(){
    const tbody = document.getElementById('dynamic-table-familiar-history');
    const newRow = document.createElement('tr');
    const allergy = document.getElementById('allergy').value;
    const relative = document.getElementById('relative').value;
    const note = document.getElementById('note').value;
    const pathSegments = window.location.pathname.split('/'); // URL
    const patient_id = pathSegments[2]; 
    console.log('patient_id:', patient_id);
    fetch(`/createFamiliarHistory/${patient_id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            allergy,
            relative,
            note
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
        appendFamiliarHistoryRow(data.id, allergy, relative, note, tbody, newRow);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function appendFamiliarHistoryRow(familiarHistory_id, allergy, relative, note, tbody, newRow) {
    newRow.className = "bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:mb-0 mb-1 rounded-lg shadow-md sm:shadow-none";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-2 font-medium text-gray-600 dark:text-gray-900 before:content-['Allergia'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${familiarHistory_id}][allergy]" value="${allergy}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Parente'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${familiarHistory_id}][relative]" value="${relative}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Nota'] before:font-bold before:block sm:before:hidden">
            <textarea name="righe[${familiarHistory_id}][note]" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" rows="2" disabled>${note}</textarea>
        </td>
        <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden">
            <button type="button" onclick="editFamiliarHistoryRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"> <i class="bi bi-pencil"></i> </button>
        </td>
        <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
            <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'confirm-history-deletion')" onclick="openDeleteFamiliarModal(this)" class="text-red-600 hover:text-red-800 dark:text-red-300 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    document.getElementById('allergy').value = "";
    document.getElementById('relative').value = "";
    document.getElementById('note').value = "";
}

window.openDeleteFamiliarModal = function(button) {
    const familiarHistory_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    document.getElementById('history_id').value = familiarHistory_id;
    document.getElementById('history_type').value = "familiar";
}

// Function to delete a row
window.deleteFamiliarRow = function() {
    const familiar_id = document.getElementById('history_id').value
    fetch(`/deleteFamiliarHistory/${familiar_id}`, {
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
    const riga = document.querySelector(`input[name^="righe[${familiar_id}]"]`);
    riga.closest('tr').remove();
    document.getElementById('history_id').value = "";
};

window.editFamiliarHistoryRow = function(button) {
    console.log('edit familiar history row');
    const allergy = document.getElementById('allergy');
    const relative = document.getElementById('relative');
    const note = document.getElementById('note');
    const familiar_history_id = document.getElementById('familiar_history_id');
    allergy.value = button.closest('tr').querySelector('input[name^="righe["][name$="[allergy]"]').value;
    relative.value = button.closest('tr').querySelector('input[name^="righe["][name$="[relative]"]').value;
    note.value = button.closest('tr').querySelector('textarea[name^="righe["][name$="[note]"]').value;
    familiar_history_id.value = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    const submitButton = document.getElementById('submit-familiar-history');
    submitButton.classList.add('hidden');
    const cancelButton = document.getElementById('cancel-familiar-history');
    cancelButton.classList.remove('hidden');
    const saveButton = document.getElementById('save-familiar-history');
    saveButton.classList.remove('hidden');
    button.closest('tr').querySelectorAll('button').forEach(button => {
        button.disabled = true; // Disable all buttons in the row
    });
};


window.saveUpdatedFamiliarHistoryRow = function(){
    const familiar_history_id = document.getElementById('familiar_history_id');
    const allergy = document.getElementById('allergy');
    const relative = document.getElementById('relative');
    const note = document.getElementById('note');

    fetch(`/editFamiliarHistory/${familiar_history_id.value}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            allergy: allergy.value,
            relative: relative.value,
            note: note.value
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Request error');
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        // Update the table row with the new values
        const row = document.querySelector(`input[name^="righe[${familiar_history_id.value}]"]`).closest('tr');
        row.querySelector('input[name^="righe["][name$="[allergy]"]').value = allergy.value;
        row.querySelector('input[name^="righe["][name$="[relative]"]').value = relative.value;
        row.querySelector('textarea[name^="righe["][name$="[note]"]').value = note.value;
        row.querySelectorAll('button').forEach(button => {
            button.disabled = false; // Disable all buttons in the row
        });
    })
    .then(() => {
        document.getElementById('allergy').value = "";
        document.getElementById('relative').value = "";
        document.getElementById('note').value = "";
        document.getElementById('familiar_history_id').value = "";
        document.getElementById('cancel-familiar-history').classList.add('hidden');
        document.getElementById('save-familiar-history').classList.add('hidden');
        document.getElementById('submit-familiar-history').classList.remove('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
}

window.cancelUpdatedFamiliarHistoryRow = function() {
   document.getElementById('cancel-familiar-history').classList.add('hidden');
   document.getElementById('save-familiar-history').classList.add('hidden');
   document.getElementById('submit-familiar-history').classList.remove('hidden');
   const familiar_history_id = document.getElementById('familiar_history_id');
   const row = document.querySelector(`input[name^="righe[${familiar_history_id.value}]"]`).closest('tr');
   row.querySelectorAll('button').forEach(button => {
       button.disabled = false; // Enable all buttons in the row
   });
}


//-------------------------------------remote history----------------------------------
console.log("Remote History Script Loaded");

document.getElementById('remote-history-form').addEventListener('submit', function(e) {
    e.preventDefault();
    newRemoteHistoryRow();
    
});

function newRemoteHistoryRow(){
    const tbody = document.getElementById('dynamic-table-remote-history');
    const newRow = document.createElement('tr');
    const remote_date = document.getElementById('remote_date').value;
    const remote_type = document.getElementById('remote_type').value;
    const remote_description = document.getElementById('remote_description').value;
    const remote_note = document.getElementById('remote_note').value;
    const pathSegments = window.location.pathname.split('/'); // URL
    const patient_id = pathSegments[2]; 
    console.log('patient_id:', patient_id);
    fetch(`/createRemotePathologicalHistory/${patient_id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            remote_date,
            remote_type,
            remote_description,
            remote_note
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
        appendRemoteHistoryRow(data.id, remote_date, remote_type, remote_description, remote_note, tbody, newRow);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function appendRemoteHistoryRow(remoteHistory_id, remote_date, remote_type, remote_description, remote_note, tbody, newRow) {
    newRow.className = "bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:mb-0 mb-1 rounded-lg shadow-md sm:shadow-none";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-2 font-medium text-gray-600 dark:text-gray-900 before:content-['Data'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${remoteHistory_id}][date]" value="${remote_date}" class="w-fullborder-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Tipo'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${remoteHistory_id}][type]" value="${remote_type}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Descrizione'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${remoteHistory_id}][description]" value="${remote_description}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Nota'] before:font-bold before:block sm:before:hidden">
            <textarea name="righe[${remoteHistory_id}][note]" class=" border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" rows="2" disabled>${remote_note}</textarea>
        </td>
        <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden">
            <button type="button" onclick="editRemoteHistoryRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"> <i class="bi bi-pencil"></i> </button>
        </td>
        <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
            <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'confirm-history-deletion')" onclick="openDeleteRemoteModal(this)" class="text-red-600 hover:text-red-800 dark:text-red-300 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    document.getElementById('remote_date').value = "";
    document.getElementById('remote_type').value = "";
    document.getElementById('remote_description').value = "";
    document.getElementById('remote_note').value = "";
}

window.openDeleteRemoteModal = function(button) {
    const remoteHistory_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    document.getElementById('history_id').value = remoteHistory_id;
    document.getElementById('history_type').value = "remote";
}

// Function to delete a row
window.deleteRemoteRow = function() {
    const remote_id = document.getElementById('history_id').value
    fetch(`/deleteRemotePathologicalHistory/${remote_id}`, {
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
    const riga = document.querySelector(`input[name^="righe[${remote_id}]"]`);
    riga.closest('tr').remove();
    document.getElementById('history_id').value = "";
};

window.editRemoteHistoryRow = function(button) {
    console.log('edit remote history row');
    const remote_date = document.getElementById('remote_date');
    const remote_type = document.getElementById('remote_type');
    const remote_description = document.getElementById('remote_description');
    const remote_note = document.getElementById('remote_note');
    const remote_history_id = document.getElementById('remote_history_id');
    remote_date.value = button.closest('tr').querySelector('input[name^="righe["][name$="[date]"]').value;
    remote_type.value = button.closest('tr').querySelector('input[name^="righe["][name$="[type]"]').value;
    remote_description.value = button.closest('tr').querySelector('input[name^="righe["][name$="[description]"]').value;
    remote_note.value = button.closest('tr').querySelector('textarea[name^="righe["][name$="[note]"]').value;
    remote_history_id.value = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    const submitRemoteButton = document.getElementById('submit-remote-history');
    submitRemoteButton.classList.add('hidden');
    const cancelRemoteButton = document.getElementById('cancel-remote-history');
    cancelRemoteButton.classList.remove('hidden');
    const saveRemoteButton = document.getElementById('save-remote-history');
    saveRemoteButton.classList.remove('hidden');
    button.closest('tr').querySelectorAll('button').forEach(button => {
        button.disabled = true; // Disable all buttons in the row
    });
};


window.saveUpdatedRemoteHistoryRow = function(){
    const remote_history_id = document.getElementById('remote_history_id');
    const remote_date = document.getElementById('remote_date');
    const remote_type = document.getElementById('remote_type');
    const remote_description = document.getElementById('remote_description');
    const remote_note = document.getElementById('remote_note');

    fetch(`/editRemotePathologicalHistory/${remote_history_id.value}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            remote_date: remote_date.value,
            remote_type: remote_type.value,
            remote_description: remote_description.value,
            remote_note: remote_note.value
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Request error');
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        // Update the table row with the new values
        const row = document.querySelector(`input[name^="righe[${remote_history_id.value}]"]`).closest('tr');
        row.querySelector('input[name^="righe["][name$="[date]"]').value = remote_date.value;
        row.querySelector('input[name^="righe["][name$="[type]"]').value = remote_type.value;
        row.querySelector('input[name^="righe["][name$="[description]"]').value = remote_description.value;
        row.querySelector('textarea[name^="righe["][name$="[note]"]').value = remote_note.value;
        row.querySelectorAll('button').forEach(button => {
            button.disabled = false; // Disable all buttons in the row
        });
    })
    .then(() => {
        document.getElementById('remote_date').value = "";
        document.getElementById('remote_type').value = "";
        document.getElementById('remote_description').value = "";
        document.getElementById('remote_note').value = "";
        document.getElementById('remote_history_id').value = "";
        document.getElementById('cancel-remote-history').classList.add('hidden');
        document.getElementById('save-remote-history').classList.add('hidden');
        document.getElementById('submit-remote-history').classList.remove('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
}

window.cancelUpdatedRemoteHistoryRow = function() {
   document.getElementById('cancel-remote-history').classList.add('hidden');
   document.getElementById('save-remote-history').classList.add('hidden');
   document.getElementById('submit-remote-history').classList.remove('hidden');
   const remote_history_id = document.getElementById('remote_history_id');
   const row = document.querySelector(`input[name^="righe[${remote_history_id.value}]"]`).closest('tr');
   row.querySelectorAll('button').forEach(button => {
       button.disabled = false; // Enable all buttons in the row
   });
}

//-------------------------------------next history----------------------------------
console.log("Next History Script Loaded");

const type = document.getElementById('next_type');
type.addEventListener('change', function() {
    if (this.value === 'ALTRO') {
        document.getElementById('next_problem').classList.replace('hidden', 'block');
        document.getElementById('next_problem-label').classList.replace('hidden', 'block');
        document.getElementById('next_problem').required = true; // Mark the input as required
    } else {
        document.getElementById('next_problem').classList.replace('block', 'hidden');
        document.getElementById('next_problem-label').classList.replace('block', 'hidden');
        document.getElementById('next_problem').value = ''; // Clear the input if not needed
        document.getElementById('next_problem').required = false; // Mark the input as not required
    }
});

document.getElementById('next-history-form').addEventListener('submit', function(e) {
    e.preventDefault();
    newNextHistoryRow();
});

function newNextHistoryRow(){
    const tbody = document.getElementById('dynamic-table-next-history');
    const newRow = document.createElement('tr');
    const next_date = document.getElementById('next_date').value;
    var next_type = document.getElementById('next_type').value;
    const next_problem = document.getElementById('next_problem').value;
    const next_name = document.getElementById('next_name').value;
    const next_cause = document.getElementById('next_cause').value;
    const next_effect = document.getElementById('next_effect').value;
    const next_note = document.getElementById('next_note').value;
    const pathSegments = window.location.pathname.split('/'); // URL
    const patient_id = pathSegments[2]; 
    if (next_type === 'ALTRO') {
        next_type = next_problem; // Use the problem as the type if 'ALTRO' is selected
    }
    fetch(`/createNextPathologicalHistory/${patient_id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            next_date,
            next_type,
            next_name,
            next_cause,
            next_effect,
            next_note
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
        appendNextHistoryRow(data.id, next_date, next_type, next_name, next_cause, next_effect, next_note, tbody, newRow);
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function appendNextHistoryRow(nextHistory_id, next_date, next_type, next_name, next_cause, next_effect, next_note, tbody, newRow) {
    newRow.className = "bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:mb-0 mb-1 rounded-lg shadow-md sm:shadow-none";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-2 font-medium text-gray-600 dark:text-gray-900 before:content-['Data'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${nextHistory_id}][date]" value="${next_date}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Tipo'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${nextHistory_id}][type]" value="${next_type}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Nome'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${nextHistory_id}][name]" value="${next_name}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Causa'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${nextHistory_id}][cause]" value="${next_cause}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Effetto'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${nextHistory_id}][effect]" value="${next_effect}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Nota'] before:font-bold before:block sm:before:hidden">
            <textarea name="righe[${nextHistory_id}][note]" class=" border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" rows="2" disabled>${next_note}</textarea>
        </td>
        <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden w-1/8">
            <button type="button" onclick="editNextHistoryRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"> <i class="bi bi-pencil"></i> </button>
        </td>
        <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
            <button type="button" x-data="" x-on:click="$dispatch('open-modal', 'confirm-history-deletion')" onclick="openDeleteNextModal(this)" class="text-red-600 hover:text-red-800 dark:text-red-300 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    document.getElementById('next_date').value = "";
    document.getElementById('next_type').selectedIndex = 0; // Reset to the first option
    document.getElementById('next_problem').value = "";
    document.getElementById('next_name').value = "";
    document.getElementById('next_cause').value = "";
    document.getElementById('next_effect').value = "";
    document.getElementById('next_note').value = "";
}

window.openDeleteNextModal = function(button) {
    const nextHistory_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    document.getElementById('history_id').value = nextHistory_id;
    document.getElementById('history_type').value = "next";
}

// Function to delete a row
window.deleteNextRow = function() {
    const next_id = document.getElementById('history_id').value
    fetch(`/deleteNextPathologicalHistory/${next_id}`, {
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
    const riga = document.querySelector(`input[name^="righe[${next_id}]"]`);
    riga.closest('tr').remove();
    document.getElementById('history_id').value = "";

};

window.editNextHistoryRow = function(button) {
    console.log('edit next history row');
    
    const next_date = document.getElementById('next_date');
    const next_type = document.getElementById('next_type');
    const next_problem = document.getElementById('next_problem');
    const next_name = document.getElementById('next_name');
    const next_cause = document.getElementById('next_cause');
    const next_effect = document.getElementById('next_effect');
    const next_note = document.getElementById('next_note');
    const next_history_id = document.getElementById('next_history_id');
    //set the values of the inputs to the values of the row being edited
    next_date.value = button.closest('tr').querySelector('input[name^="righe["][name$="[date]"]').value;

    const values = Array.from(next_type.options).map(option => option.value);
    const appoggio = button.closest('tr').querySelector('input[name^="righe["][name$="[type]"]').value;
    if (!values.includes(appoggio)){
        next_problem.value = appoggio;
        next_type.value = "ALTRO";
        document.getElementById('next_problem').classList.replace('hidden', 'block');
        document.getElementById('next_problem-label').classList.replace('hidden', 'block');
        document.getElementById('next_problem').required = true; // Mark the input as required
    } else{
        next_problem.value = "";
        next_type.value = appoggio;
    }
    next_name.value = button.closest('tr').querySelector('input[name^="righe["][name$="[name]"]').value;
    next_cause.value = button.closest('tr').querySelector('input[name^="righe["][name$="[cause]"]').value;
    next_effect.value = button.closest('tr').querySelector('input[name^="righe["][name$="[effect]"]').value;
    next_note.value = button.closest('tr').querySelector('textarea[name^="righe["][name$="[note]"]').value;
    next_history_id.value = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    // display the Annulla and Salva buttons; then hide the Submit button and disable all buttons in the row
    const submitNextButton = document.getElementById('submit-next-history');
    submitNextButton.classList.add('hidden');
    const cancelNextButton = document.getElementById('cancel-next-history');
    cancelNextButton.classList.remove('hidden');
    const saveNextButton = document.getElementById('save-next-history');
    saveNextButton.classList.remove('hidden');
    button.closest('tr').querySelectorAll('button').forEach(button => {
        button.disabled = true; // Disable all buttons in the row
    });
};


window.saveUpdatedNextHistoryRow = function(){
    const next_history_id = document.getElementById('next_history_id');
    const next_date = document.getElementById('next_date').value;
    var next_type = document.getElementById('next_type').value;
    const next_problem = document.getElementById('next_problem').value;
    const next_name = document.getElementById('next_name').value;
    const next_cause = document.getElementById('next_cause').value;
    const next_effect = document.getElementById('next_effect').value;
    const next_note = document.getElementById('next_note').value;
    if (next_type === 'ALTRO') {
        next_type = next_problem; // Use the problem as the type if 'ALTRO' is selected
    }
    fetch(`/editNextPathologicalHistory/${next_history_id.value}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            next_date,
            next_type,
            next_name,
            next_cause,
            next_effect,
            next_note
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Request error');
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        // Update the table row with the new values
        const row = document.querySelector(`input[name^="righe[${next_history_id.value}]"]`).closest('tr');
        row.querySelector('input[name^="righe["][name$="[date]"]').value = next_date;
        row.querySelector('input[name^="righe["][name$="[type]"]').value = next_type;
        row.querySelector('input[name^="righe["][name$="[name]"]').value = next_name;
        row.querySelector('input[name^="righe["][name$="[cause]"]').value = next_cause;
        row.querySelector('input[name^="righe["][name$="[effect]"]').value = next_effect;
        row.querySelector('textarea[name^="righe["][name$="[note]"]').value = next_note;
        row.querySelectorAll('button').forEach(button => {
            button.disabled = false; // Disable all buttons in the row
        });
    })
    .then(() => {
        document.getElementById('next_date').value = "";
        document.getElementById('next_type').selectedIndex = 0 ;
        document.getElementById('next_name').value = "";
        document.getElementById('next_cause').value = "";
        document.getElementById('next_effect').value = "";
        document.getElementById('next_note').value = "";
        document.getElementById('next_history_id').value = "";
        document.getElementById('next_problem').classList.replace('block', 'hidden');
        document.getElementById('next_problem-label').classList.replace('block', 'hidden');
        document.getElementById('next_problem').value = ''; // Clear the input if not needed
        document.getElementById('next_problem').required = false; // Mark the input as not required
        document.getElementById('cancel-next-history').classList.add('hidden');
        document.getElementById('save-next-history').classList.add('hidden');
        document.getElementById('submit-next-history').classList.remove('hidden');
    })
    .catch(error => {
        console.error('Error:', error);
    });
    
}

window.cancelUpdatedNextHistoryRow = function() {
    document.getElementById('cancel-next-history').classList.add('hidden');
    document.getElementById('save-next-history').classList.add('hidden');
    document.getElementById('submit-next-history').classList.remove('hidden');

    document.getElementById('next_problem').classList.replace('block', 'hidden');
    document.getElementById('next_problem-label').classList.replace('block', 'hidden');
    document.getElementById('next_problem').value = ''; // Clear the input if not needed
    document.getElementById('next_problem').required = false; // Mark the input as not required
    const next_history_id = document.getElementById('next_history_id');
    const row = document.querySelector(`input[name^="righe[${next_history_id.value}]"]`).closest('tr');
    row.querySelectorAll('button').forEach(button => {
        button.disabled = false; // Enable all buttons in the row
    });
}