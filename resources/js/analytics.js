console.log('Analytics script loaded');

window.showStep = function(step) {
    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const step3 = document.getElementById('step-3');
    const step1Indicator = document.getElementById('step-1-indicator');
    const step2Indicator = document.getElementById('step-2-indicator');
    const step3Indicator = document.getElementById('step-3-indicator');
    const listItems = document.querySelectorAll('li');
    const spanElements = document.querySelectorAll('span .shrink-0');

    
    switch (step) {
        case 1:
            step1.classList.remove('hidden');
            step2.classList.add('hidden');
            step3.classList.add('hidden');  
            listItems[0].classList.add('text-blue-600', 'dark:text-blue-500');
            listItems[0].classList.remove('text-gray-500', 'dark:text-gray-400');
            step1Indicator.classList.add('border-blue-600', 'dark:border-blue-500');
            step1Indicator.classList.remove('border-gray-500', 'dark:border-gray-400');
            listItems[1].classList.remove('text-blue-600', 'dark:text-blue-500');
            listItems[1].classList.add('text-gray-500', 'dark:text-gray-400');
            step2Indicator.classList.add('border-gray-500', 'dark:border-gray-400');
            step2Indicator.classList.remove('border-blue-600', 'dark:border-blue-500');
            listItems[2].classList.remove('text-blue-600', 'dark:text-blue-500');
            listItems[2].classList.add('text-gray-500', 'dark:text-gray-400');
            step3Indicator.classList.add('border-gray-500', 'dark:border-gray-400');
            step3Indicator.classList.remove('border-blue-600', 'dark:border-blue-500');
            break;
        case 2:
            step2.classList.remove('hidden');
            step1.classList.add('hidden');
            step3.classList.add('hidden');
            listItems[0].classList.remove('text-blue-600', 'dark:text-blue-500');
            listItems[0].classList.add('text-gray-500', 'dark:text-gray-400');
            step1Indicator.classList.remove('border-blue-600', 'dark:border-blue-500');
            step1Indicator.classList.add('border-gray-500', 'dark:border-gray-400');
            listItems[1].classList.remove('text-gray-500', 'dark:text-gray-400');
            listItems[1].classList.add('text-blue-600', 'dark:text-blue-500');
            step2Indicator.classList.add('border-blue-600', 'dark:border-blue-500');
            step2Indicator.classList.remove('border-gray-500', 'dark:border-gray-400');
            listItems[2].classList.add('text-gray-500', 'dark:text-gray-400');
            listItems[2].classList.remove('text-blue-600', 'dark:text-blue-500');
            step3Indicator.classList.remove('border-blue-600', 'dark:border-blue-500');
            step3Indicator.classList.add('border-gray-500', 'dark:border-gray-400');
            break;
        case 3:
            step3.classList.remove('hidden');
            step1.classList.add('hidden');
            step2.classList.add('hidden');
            listItems[0].classList.remove('text-blue-600', 'dark:text-blue-500');
            listItems[0].classList.add('text-gray-500', 'dark:text-gray-400');
            step1Indicator.classList.remove('border-blue-600', 'dark:border-blue-500');
            step1Indicator.classList.add('border-gray-500', 'dark:border-gray-400');
            listItems[1].classList.add('text-gray-500', 'dark:text-gray-400');
            listItems[1].classList.remove('text-blue-600', 'dark:text-blue-500');
            step2Indicator.classList.remove('border-blue-600', 'dark:border-blue-500');
            step2Indicator.classList.add('border-gray-500', 'dark:border-gray-400');
            listItems[2].classList.remove('text-gray-500', 'dark:text-gray-400');
            listItems[2].classList.add('text-blue-600', 'dark:text-blue-500');
            step3Indicator.classList.add('border-blue-600', 'dark:border-blue-500');
            step3Indicator.classList.remove('border-gray-500', 'dark:border-gray-400');
            break;
    }
}

showStep(1);