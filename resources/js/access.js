console.log('Access JavaScript loaded');

const login = document.getElementById('form1');
const register = document.getElementById('form2');

const form1Content = document.querySelector('.form1-content');
const form2Content = document.querySelector('.form2-content');

function showForm(type) {
    if (type === 'register') {
        register.classList.replace('text-gray-400', 'text-blue-600');
        login.classList.replace('text-blue-600', 'text-gray-400');
        
        form1Content.classList.add('hidden');
        form2Content.classList.remove('hidden');
    } else {
        login.classList.replace('text-gray-400', 'text-blue-600');
        register.classList.replace('text-blue-600', 'text-gray-400');

        form2Content.classList.add('hidden');
        form1Content.classList.remove('hidden');
    }
}

login.addEventListener('click', () => showForm('login'));
register.addEventListener('click', () => showForm('register'));
