console.log('Access JavaScript loaded');

const login = document.getElementById('form1');
const register = document.getElementById('form2');

const form1Content = document.querySelector('.form1-content');
const form2Content = document.querySelector('.form2-content');

function showForm(type) {
    if (type === 'register') {
        login.classList.replace('text-gray-200', 'text-black');
        register.classList.replace('text-black', 'text-gray-200');
        login.classList.replace('dark:text-black', 'dark:text-white');
        register.classList.replace('dark:text-white', 'dark:text-black');

        form1Content.classList.add('hidden');
        form2Content.classList.remove('hidden');
    } else {
        register.classList.replace('text-gray-200', 'text-black');
        login.classList.replace('text-black', 'text-gray-200');
        
        login.classList.replace('dark:text-white', 'dark:text-black');
        register.classList.replace('dark:text-black', 'dark:text-white');

        form2Content.classList.add('hidden');
        form1Content.classList.remove('hidden');
    }
}

login.addEventListener('click', () => showForm('login'));
register.addEventListener('click', () => showForm('register'));
