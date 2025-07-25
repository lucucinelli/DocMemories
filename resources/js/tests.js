console.log("Test script loaded");

const testsArrowDown = document.getElementById('tests-toggle-Down');
const testsArrowUp = document.getElementById('tests-toggle-Up');
testsArrowDown.addEventListener('click', () => {
    const testsSection = document.getElementById('tests-list');
    testsSection.classList.toggle('hidden');
    testsArrowDown.classList.add('hidden');
    testsArrowUp.classList.remove('hidden');
});

testsArrowUp.addEventListener('click', () => {
    const testsSection = document.getElementById('tests-list');
    testsSection.classList.toggle('hidden');
    testsArrowDown.classList.remove('hidden');
    testsArrowUp.classList.add('hidden');
});