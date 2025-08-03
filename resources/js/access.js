console.log('Access JavaScript loaded');


const login = document.getElementById('form1');
const register = document.getElementById('form2');

const form2Content = document.querySelector('.form2-content');

form2Content.classList.add('hidden'); // Hide register form initially

login.addEventListener('click', () => {
    register.classList.replace('text-blue-600', 'text-gray-400');
    login.classList.replace('text-gray-400', 'text-blue-600');
    document.querySelector('.form1-content').classList.remove('hidden');
    document.querySelector('.form2-content').classList.add('hidden');
});

register.addEventListener('click', () => {
    login.classList.replace('text-blue-600', 'text-gray-400');
    register.classList.replace('text-gray-400', 'text-blue-600');
    document.querySelector('.form2-content').classList.remove('hidden');
    document.querySelector('.form1-content').classList.add('hidden');
});
