// Caricamento note salvate
document.addEventListener('DOMContentLoaded', function () {
    const saved = localStorage.getItem('advanced_notes');
    if (saved) {
      document.getElementById('notes').value = saved;
    }
});

// Salvataggio automatico
const notesField = document.getElementById('notes');


notesField.addEventListener('input', () => {
    const status = document.getElementById('saveStatus');
    localStorage.setItem('advanced_notes', notesField.value);
    status.classList.remove('hidden');
    clearTimeout(status._timeout);
    status._timeout = setTimeout(() => status.classList.add('hidden'), 1000);
});

// Cancella note
window.clearNotes = function() {
    // Mostra il popup personalizzato
    document.getElementById('confirmModal').classList.remove('hidden');
    document.getElementById('confirmModal').classList.add('flex');
}

window.hideModal = function() {
  document.getElementById('confirmModal').classList.add('hidden');
  document.getElementById('confirmModal').classList.remove('flex');
}

window.confirmClearNotes = function() {
  // Esegui la cancellazione vera
  const notesField = document.getElementById('notes');
  const status = document.getElementById('saveStatus');

  notesField.value = '';
  localStorage.removeItem('advanced_notes');

  // Mostra messaggio temporaneo
  status.textContent = 'Note cancellate';
  status.classList.remove('hidden');
  setTimeout(() => {
    status.textContent = 'Salvato';
    status.classList.add('hidden');
  }, 1500);

  // Chiudi il modale
  hideModal();
}