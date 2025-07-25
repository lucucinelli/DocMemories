console.log("Exam script loaded");

const toggleBtn = document.getElementById('exams-toggle-Down');
const examsSection = document.getElementById('exams-list');

toggleBtn.addEventListener('click', () => {
    examsSection.classList.toggle('hidden');

    if (toggleBtn.classList.contains('bi-caret-down-fill')) {
        toggleBtn.classList.replace('bi-caret-down-fill', 'bi-caret-up-fill');
    } else {
        toggleBtn.classList.replace('bi-caret-up-fill', 'bi-caret-down-fill');
    }
});