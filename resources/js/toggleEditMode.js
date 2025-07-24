
export function toggleEditMode() {
    const cancelButton = document.getElementById('cancel-button');
    const saveButton = document.getElementById('save-button');
    const editButton = document.getElementById('edit-button');

    cancelButton.classList.toggle('hidden');
    saveButton.classList.toggle('hidden');
    editButton.classList.toggle('hidden');

    toggleInputState();

    console.log("Edit mode toggled");
}

function toggleInputState(){
    const inputs = document.querySelectorAll('.anag rafica');
    inputs.forEach(input => {
        input.disabled = !input.disabled;
    });
    console.log("Input state toggled");
}