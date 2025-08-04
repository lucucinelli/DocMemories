console.log('Analytics script loaded');
let currentChart = null;

window.showStep = function(step) {
    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const step3 = document.getElementById('step-3');
    const step1Indicator = document.getElementById('step-1-indicator');
    const step2Indicator = document.getElementById('step-2-indicator');
    const step3Indicator = document.getElementById('step-3-indicator');
    const listItems = document.querySelectorAll('li');
    
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
            if (currentChart) {
                currentChart.destroy(); 
            }
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


/*------------------------------------------question-1----------------------------------------------- */
document.getElementById('question-1').addEventListener('click', function() {
    const errorMessage = document.getElementById('error-message');
    const chartType = document.getElementById('chart-type').value;
    const fromDate = document.getElementById('date_from').value;
    const toDate = document.getElementById('date_to').value;
    // fetch data from the server
    fetch('/analytics/countOfPatients', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            // any necessary data to send to the server
            fromDate: fromDate,
            toDate: toDate
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'empty') {
            console.log('No data available for the selected period.');
            errorMessage.classList.remove('hidden');
            if (currentChart) {
                currentChart.destroy();
            }
        } else {
            errorMessage.classList.add('hidden');
            createChart(chartType, data.labels, data.counts);
        }
    });
});

/*------------------------------------------question-2/11----------------------------------------------- */
document.getElementById('question-2').addEventListener('click', function() {
    Patology('asma');
});
document.getElementById('question-3').addEventListener('click', function() {
    Patology('rinite');
});
document.getElementById('question-4').addEventListener('click', function() {
    Patology('poliposi nasale');
});
document.getElementById('question-5').addEventListener('click', function() {
    Patology('congiuntivite');
});
document.getElementById('question-6').addEventListener('click', function() {
    Patology('dermatite');
});
document.getElementById('question-7').addEventListener('click', function() {
    Patology('aliment');
});
document.getElementById('question-8').addEventListener('click', function() {
    Patology('beta-lattamic');
});
document.getElementById('question-9').addEventListener('click', function() {
    Patology('antibiotic');
});
document.getElementById('question-10').addEventListener('click', function() {
    Patology('antinfiamma');
});
document.getElementById('question-11').addEventListener('click', function() {
    Patology('imenotteri');
});

function Patology(patology) {
    const errorMessage = document.getElementById('error-message');
    const chartType = document.getElementById('chart-type').value;
    const fromDate = document.getElementById('date_from').value;
    const toDate = document.getElementById('date_to').value;
    // fetch data from the server
    fetch('/analytics/patology', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            // any necessary data to send to the server
            fromDate: fromDate,
            toDate: toDate,
            patology: patology
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'empty') {
            console.log('No data available for the selected period.');
            errorMessage.classList.remove('hidden');
            if (currentChart) {
                currentChart.destroy();
            }
        } else {
            errorMessage.classList.add('hidden');
            createChart(chartType, data.labels, data.counts);
        }
    });
};

/*------------------------------------------chart----------------------------------------------- */
function createChart(type, label, datasets){
    var display = true;
    if (type == 'bar' || type == 'line') {
        display = false;
    }

    const ctx = document.getElementById('analytics-chart').getContext('2d');

    if (currentChart) {
        currentChart.destroy();
    }

    currentChart = new Chart(ctx, {
        type: type,
        data: {
            labels: label,
            datasets: [{
                label: 'Pazienti',
                data: datasets,
                backgroundColor: [
                    '#FF6384',
                    '#36A2EB',
                    '#FFCE56',
                    '#4BC0C0',
                    '#9966FF',
                    '#FF9F40',
                    '#FF6384',
                    '#66BB6A',
                    '#EF5350',
                ],
                borderWidth: 1,
                hoverBorderWidth: 2,
                hoverBorderColor: '#000000'
            }]
        },
        options: {  
            responsive: true,
            plugins: {
                legend: {
                    display: display,
                    position: 'right',
                }
            },
            scales: type === 'pie' || type === 'doughnut' ? {} : {
                y: {
                    beginAtZero: true
                }
            }
        }

    });
}
