//---------------------------------------generic------------------------------------------------
const tabs = document.querySelectorAll(".tab-btn");
const contents = document.querySelectorAll(".contenuto");

function showTab(tabName) {
    contents.forEach(c => c.classList.add("hidden"));
    document.querySelector(`[data-content="${tabName}"]`).classList.remove("hidden");

    tabs.forEach(t => {
    t.classList.remove("bg-orange-400", "text-white", "font-semibold");
    t.classList.add("bg-white", "text-gray-700");
    });

    const activeTab = document.querySelector(`[data-tab="${tabName}"]`);
    activeTab.classList.remove("bg-white", "text-gray-700");
    activeTab.classList.add("bg-orange-400", "text-white", "font-semibold");
}

// Inizializzazione: mostra la prima tab
showTab("physiological");

tabs.forEach(tab => {
    tab.addEventListener("click", () => {
    const tabName = tab.getAttribute("data-tab");
    showTab(tabName);
    });
});


// ----------------------------------next pathological history----------------------------------
const type = document.getElementById('type');
type.addEventListener('change', function() {
    if (this.value === 'ALTRO') {
        document.getElementById('problem').classList.replace('hidden', 'block');
        document.getElementById('problem-label').classList.replace('hidden', 'block');
        document.getElementById('problem').required = true; // Mark the input as required
    } else {
        document.getElementById('problem').classList.replace('block', 'hidden');
        document.getElementById('problem-label').classList.replace('block', 'hidden');
        document.getElementById('problem').value = ''; // Clear the input if not needed
        document.getElementById('problem').required = false; // Mark the input as not required
    }
});

//-------------------------------------familiar history----------------------------------
console.log("Familiar History Script Loaded");

document.getElementById('familiar-history-form').addEventListener('submit', function(e) {
            e.preventDefault();
            newFamiliarHistoryRow();
            console.log('nessuna richiesta inviata.');
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
    newRow.className = "bg-gray-300 dark:bg-gray-600 dark:border-gray-700 border-b border-gray-200 sm:table-row flex flex-col sm:flex-row sm:table-row sm:mb-0 mb-1 rounded-lg shadow-md sm:shadow-none";
    newRow.innerHTML = `
        <td scope="row" class="px-6 py-2 font-medium text-gray-600 dark:text-gray-900 before:content-['Allergia'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${familiarHistory_id}][allergy]" value="${allergy}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Parente'] before:font-bold before:block sm:before:hidden">
            <input name="righe[${familiarHistory_id}][relative]" value="${relative}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" disabled>
        </td>
        <td class="px-6 py-2 dark:text-gray-500 before:content-['Nota'] before:font-bold before:block sm:before:hidden">
            <textarea name="righe[${familiarHistory_id}][note]" class="border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full" rows="2" disabled>${note}</textarea>
        </td>
        <td class="px-6 py-2 text-center before:content-['Modifica'] before:font-bold before:block sm:before:hidden">
            <button type="button" onclick="editFamiliarHistoryRow(this)" class="text-blue-600 hover:text-blue-800 font-bold dark:text-blue-300"> <i class="bi bi-pencil"></i> </button>
        </td>
        <td class="px-6 py-2 text-center before:content-['Rimuovi'] before:font-bold before:block sm:before:hidden">
            <button type="button" onclick="deleteFamiliarHistoryRow(this)" class="text-red-600 hover:text-red-800 dark:text-red-300 font-bold">✕</button>
        </td>
    `;
    tbody.appendChild(newRow);
    document.getElementById('allergy').value = "";
    document.getElementById('relative').value = "";
    document.getElementById('note').value = "";
}


window.deleteFamiliarHistoryRow = function(button) {
    console.log('delete familiar history row');
    const familiarHistory_id = button.closest('tr').querySelector('input[name^="righe["]').name.match(/\d+/)[0];
    fetch(`/deleteFamiliarHistory/${familiarHistory_id}`, {
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
        const submitButton = document.getElementById('submit-familiar-history');
        submitButton.classList.remove('hidden');
        const cancelButton = document.getElementById('cancel-familiar-history');
        cancelButton.classList.add('hidden');
        const saveButton = document.getElementById('save-familiar-history');
        saveButton.classList.add('hidden');
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