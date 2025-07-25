console.log("Test script loaded");

const toggleBtn = document.getElementById('tests-toggle-Down');
const testsSection = document.getElementById('tests-list');

toggleBtn.addEventListener('click', () => {
    testsSection.classList.toggle('hidden');

    if (toggleBtn.classList.contains('bi-caret-down-fill')) {
        toggleBtn.classList.replace('bi-caret-down-fill', 'bi-caret-up-fill');
    } else {
        toggleBtn.classList.replace('bi-caret-up-fill', 'bi-caret-down-fill');
    }
});
