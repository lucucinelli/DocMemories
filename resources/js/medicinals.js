console.log("Medicinal script loaded");

const toggleBtn = document.getElementById('medicinals-toggle-Down');
const medicinalsSection = document.getElementById('medicinals-list');

toggleBtn.addEventListener('click', () => {
    medicinalsSection.classList.toggle('hidden');

    if (toggleBtn.classList.contains('bi-caret-down-fill')) {
        toggleBtn.classList.replace('bi-caret-down-fill', 'bi-caret-up-fill');
    } else {
        toggleBtn.classList.replace('bi-caret-up-fill', 'bi-caret-down-fill');
    }
});