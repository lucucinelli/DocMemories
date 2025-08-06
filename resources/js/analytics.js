console.log('Analytics script loaded');
let currentChart = null;
let currentChartStepper = null;
Chart.defaults.color = '#706E6E';
Chart.defaults.font.family = 'Arial, sans-serif';
Chart.defaults.font.size = 20;

function stepperDefaults(){
    document.getElementById('gender').checked = true; // Set default selection
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = false; // Uncheck all checkboxes
    });
    document.getElementById('age-range').value = '%'; // Set default age range
    document.getElementById('age-value-min').value = ''; // Clear minimum age input
    document.getElementById('age-value-max').value = ''; // Clear maximum age input
    document.getElementById('age-value').value = '';
}
stepperDefaults();

document.getElementById('prev-step-3').addEventListener('click', function (){
    document.getElementById('error-message-stepper').classList.add("hidden");
});

window.resetCheckbox = function(){
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        checkbox.checked = false; // Uncheck all checkboxes
    });
    document.getElementById('age-range').selectedIndex = 0;
    document.getElementById('age-range').dispatchEvent(new Event('change'));
    document.getElementById('age-value-min').value = ''; // Clear minimum age input
    document.getElementById('age-value-max').value = ''; // Clear maximum age input
    document.getElementById('age-value').value = '';
}

window.showStep = function(step) {
    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const step3 = document.getElementById('step-3');
    const step1Indicator = document.getElementById('step-1-indicator');
    const step2Indicator = document.getElementById('step-2-indicator');
    const step3Indicator = document.getElementById('step-3-indicator');
    const listItems = document.querySelectorAll('.stepper');
    
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

/*------------------------------------------stepper----------------------------------------------- */

/*--------------step 2 -----------------*/

document.getElementById('date_from-stepper').type = 'date';
document.getElementById('date_from-stepper').value = new Date().getFullYear() + '-01-01';
document.getElementById('date_to-stepper').type = 'date';
document.getElementById('date_to-stepper').value = new Date().toISOString().split('T')[0];

document.getElementById('year').addEventListener('change', function() {
    document.getElementById('date_from-stepper').type = 'number';
    document.getElementById('date_from-stepper').value = new Date().getFullYear()-3;
    document.getElementById('date_to-stepper').type = 'number';
    document.getElementById('date_to-stepper').value = new Date().getFullYear();
});

document.getElementById('gender').addEventListener('change', function() {
    document.getElementById('date_from-stepper').type = 'date';
    document.getElementById('date_from-stepper').value = new Date().getFullYear() + '-01-01';
    document.getElementById('date_to-stepper').type = 'date';
    document.getElementById('date_to-stepper').value = new Date().toISOString().split('T')[0];
});

/*--------------step 3 - ages ------------ */

document.getElementById('age-range').addEventListener('change', function() {
    const age_select = document.getElementById('age-range').value;
    switch (age_select){
        case "compreso":
            document.getElementById('maggiore-minore').classList.add('hidden');
            document.getElementById('compreso').classList.remove('hidden');
            break;
        case ">":
            document.getElementById('compreso').classList.add('hidden');
            document.getElementById('maggiore-minore').classList.remove('hidden');
            break;
        case "<":
            document.getElementById('compreso').classList.add('hidden');
            document.getElementById('maggiore-minore').classList.remove('hidden');
            break;
        default:
            document.getElementById('maggiore-minore').classList.add('hidden');
            document.getElementById('compreso').classList.add('hidden');
    }
});


/*--------------step 3 - create chart -----------------*/
console.log('Create your chart');

const formStepper = document.getElementById('analytics-form-stepper').addEventListener('submit', function(event) {
    event.preventDefault(); // avoid the reload of the page
    const errorMessage = document.getElementById('error-message-stepper');
    const formData = new FormData(this);

    fetch('/analytics/persChart', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.message === 'empty') {
            console.log('No data available for the selected period.');
            errorMessage.classList.remove('hidden');
            if (currentChartStepper) {
                currentChartStepper.destroy();
            }
        } else {
            errorMessage.classList.add('hidden');
            let title = "Grafico personalizzato";
            createChartStepper(data.type, data.labels, data.counts, title);
        }
    });
});
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
            createChart(chartType, data.labels, data.counts, 'Quanti pazienti sono stati visitati?');
        }
    });
});

/*------------------------------------------question-2/11----------------------------------------------- */
document.getElementById('question-2').addEventListener('click', function() {
    Patology('asma', 'Quanti pazienti sono affetti da asma?');
});
document.getElementById('question-3').addEventListener('click', function() {
    Patology('rinite', 'Quanti pazienti sono affetti da rinite?');
});
document.getElementById('question-4').addEventListener('click', function() {
    Patology('poliposi nasale', 'Quanti pazienti sono affetti da poliposi nasale?');
});
document.getElementById('question-5').addEventListener('click', function() {
    Patology('congiuntivite', 'Quanti pazienti sono affetti da congiuntivite?');
});
document.getElementById('question-6').addEventListener('click', function() {
    Patology('dermatite', 'Quanti pazienti sono affetti da dermatite?');
});
document.getElementById('question-7').addEventListener('click', function() {
    Patology('aliment', 'Quanti pazienti sono affetti da allergie alimentari?');
});
document.getElementById('question-8').addEventListener('click', function() {
    Patology('beta-lattamic', 'Quanti pazienti sono affetti da allergie al beta-lattamico?');
});
document.getElementById('question-9').addEventListener('click', function() {
    Patology('antibiotic', 'Quanti pazienti sono affetti da allergie agli antibiotici?');
});
document.getElementById('question-10').addEventListener('click', function() {
    Patology('antinfiamma', 'Quanti pazienti sono affetti da antinfiammatori?');
});
document.getElementById('question-11').addEventListener('click', function() {
    Patology('imenotteri', 'Quanti pazienti sono affetti da veleno di imenotteri?');
});

function Patology(patology, title) {
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
            document.getElementById('analytics-chart-container').classList.add('hidden');
            if (currentChart) {
                currentChart.destroy();
            }
        } else {
            errorMessage.classList.add('hidden');
            createChart(chartType, data.labels, data.counts, title);
        }
    });
};

/*------------------------------------------chart----------------------------------------------- */
function createChart(type, label, datasets, title){
    document.getElementById('analytics-chart-container').classList.remove('hidden');
    var display = true;
    if (type == 'bar' || type == 'line') {
        display = false;
    }

    const ctx = document.getElementById('analytics-chart').getContext('2d');

    if (currentChart) {
        currentChart.destroy();
    }
    

    const config = {
        type: type,
        data: {
            labels: label,
            datasets: [{
                label: 'Pazienti',
                data: datasets,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                ],
                fill: type === 'line' || type === 'bar' ? true : false,
                borderWidth: 1,
                hoverBorderWidth: 2,
                hoverBorderColor: '#000000'
            }]
        },
        options: {  
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: title,
                    font: {
                        size: 24,
                        weight: 'bold',
                    },
                },
                legend: {
                    display: display,
                    position: 'right',
                },
                datalabels: {
                    formatter: ((value, context) => {
                        const totalSum = context.dataset.data.reduce((acc, val) => {return acc + val}, 0);
                        const percentage = ((value / totalSum) * 100).toFixed(2);
                        return `${percentage}%`;
                    }),
                }
                
            },
            scales: type === 'pie' || type === 'doughnut' ? {} : {
                y: {
                    beginAtZero: true
                }
            },
        },
        plugins: type === 'pie' || type === 'doughnut' ? [ChartDataLabels] : []

    };

    currentChart = new Chart(ctx, config );
}

function createChartStepper(type, label, datasets, title){
    document.getElementById('analytics-chart-container-stepper').classList.remove('hidden');
    var display = true;
    if (type == 'bar' || type == 'line') {
        display = false;
    }

    const ctx = document.getElementById('analytics-chart-stepper').getContext('2d');

    if (currentChartStepper) {
        currentChartStepper.destroy();
    }

    const config = {
        type: type,
        data: {
            labels: label,
            datasets: [{
                label: 'Pazienti',
                data: datasets,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)',
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                ],
                fill: type === 'line' || type === 'bar' ? true : false,
                borderWidth: 1,
                hoverBorderWidth: 2,
                hoverBorderColor: '#000000'
            }]
        },
        options: {  
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: title,
                    font: {
                        size: 24,
                        weight: 'bold',
                    },
                },
                legend: {
                    display: display,
                    position: 'right',
                },
                datalabels: {
                    formatter: ((value, context) => {
                        const totalSum = context.dataset.data.reduce((acc, val) => {return acc + val}, 0);
                        const percentage = ((value / totalSum) * 100).toFixed(2);
                        return `${percentage}%`;
                    }),
                }
                
            },
            scales: type === 'pie' || type === 'doughnut' ? {} : {
                y: {
                    beginAtZero: true
                }
            },
        },
        plugins: type === 'pie' || type === 'doughnut' ? [ChartDataLabels] : []

    };

    currentChartStepper = new Chart(ctx, config );
}
