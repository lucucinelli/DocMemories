console.log("Exam script loaded");

const toggleBtn = document.getElementById('exams-toggle');
const toggleDownIcon = document.getElementById('exams-toggle-Down');
const examsSection = document.getElementById('exams-list');

toggleBtn.addEventListener('click', () => {
    examsSection.classList.toggle('hidden');
    examsSection.scrollIntoView({ behavior: 'smooth' });

    if (toggleDownIcon.classList.contains('bi-caret-down-fill')) {
        toggleDownIcon.classList.replace('bi-caret-down-fill', 'bi-caret-up-fill');
    } else {
        toggleDownIcon.classList.replace('bi-caret-up-fill', 'bi-caret-down-fill');
    }
});