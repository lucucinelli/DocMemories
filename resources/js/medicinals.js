console.log("Medicinals script loaded");

const medicinalsArrowDown = document.getElementById('medicinals-toggle-Down');
const medicinalsArrowUp = document.getElementById('medicinals-toggle-Up');
medicinalsArrowDown.addEventListener('click', () => {
    const medicinalsSection = document.getElementById('medicinals-list');
    medicinalsSection.classList.toggle('hidden');
    medicinalsArrowDown.classList.add('hidden');
    medicinalsArrowUp.classList.remove('hidden');
});

medicinalsArrowUp.addEventListener('click', () => {
    const medicinalsSection = document.getElementById('medicinals-list');
    medicinalsSection.classList.toggle('hidden');
    medicinalsArrowDown.classList.remove('hidden');
    medicinalsArrowUp.classList.add('hidden');
});