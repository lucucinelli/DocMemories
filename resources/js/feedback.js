document.getElementById('note').addEventListener('input', function() {
    const note = document.getElementById('note');
    if (note.value != "") {
        document.getElementById('submit-button').classList.remove('hidden');
    } else {
        document.getElementById('submit-button').classList.add('hidden');
    }
});
