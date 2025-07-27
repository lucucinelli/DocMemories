console.log("Medicinal script loaded");

const toggleBtn = document.getElementById('medicinals-toggle');
const toggleDownIcon = document.getElementById('medicinals-toggle-Down');
const medicinalsSection = document.getElementById('medicinals-list');

toggleBtn.addEventListener('click', () => {
    medicinalsSection.classList.toggle('hidden');
    medicinalsSection.scrollIntoView({ behavior: 'smooth' });

    if (toggleDownIcon.classList.contains('bi-caret-down-fill')) {
        toggleDownIcon.classList.replace('bi-caret-down-fill', 'bi-caret-up-fill');
    } else {
        toggleDownIcon.classList.replace('bi-caret-up-fill', 'bi-caret-down-fill');
    }
});