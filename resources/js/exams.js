console.log("Exams script loaded");

document.addEventListener('DOMContentLoaded', () => {
    const examsArrowDown = document.getElementById('exams-toggle-Down');
    const examsArrowUp = document.getElementById('exams-toggle-Up');
    examsArrowDown.addEventListener('click', () => {
        const examsSection = document.getElementById('exams-list');
        examsSection.classList.toggle('hidden');
        examsArrowDown.classList.add('hidden');
        examsArrowUp.classList.remove('hidden');
    });

    examsArrowUp.addEventListener('click', () => {
        const examsSection = document.getElementById('exams-list');
        examsSection.classList.toggle('hidden');
        examsArrowDown.classList.remove('hidden');
        examsArrowUp.classList.add('hidden');
    });
});