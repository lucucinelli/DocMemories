// Menù of reports - dashboard page 
resetReportFilters();   
let currentReportChart = null;

document.getElementById('patients-tab').addEventListener('click', function() {
    document.getElementById('patients-report').classList.remove('hidden');
    document.getElementById('visits-report').classList.add('hidden');
    document.getElementById('reservations-report').classList.add('hidden');
    document.getElementById('tabs').value = 'Patients';
});

document.getElementById('visits-tab').addEventListener('click', function() {
    document.getElementById('patients-report').classList.add('hidden');
    document.getElementById('visits-report').classList.remove('hidden');
    document.getElementById('reservations-report').classList.add('hidden');
    document.getElementById('tabs').value = 'Visits';
    createChartReportVisit();
});

document.getElementById('reservations-tab').addEventListener('click', function() {
    document.getElementById('patients-report').classList.add('hidden');
    document.getElementById('visits-report').classList.add('hidden');
    document.getElementById('reservations-report').classList.remove('hidden');
    document.getElementById('tabs').value = 'Reservations';
});

document.getElementById('tabs').addEventListener('change', function() {
    const selectedValue = this.value;
    document.getElementById('patients-report').classList.toggle('hidden', selectedValue !== 'Patients');
    document.getElementById('visits-report').classList.toggle('hidden', selectedValue !== 'Visits');
    document.getElementById('reservations-report').classList.toggle('hidden', selectedValue !== 'Reservations');
});

function resetReportFilters() {
    document.getElementById('report-period').value = 'years';
    document.getElementById('years-range').classList.remove('hidden');
    document.getElementById('months-range').classList.add('hidden');
    resetValueFilters();
}
function resetValueFilters(){
    document.getElementById('from-year').value = '';
    document.getElementById('to-year').value = '';
    document.getElementById('from-month').value = '01';
    document.getElementById('to-month').value = '12';
    document.getElementById('reference-year').value = '';
}

document.getElementById('report-period').addEventListener('change', function() {
    const selectedValue = this.value;
    document.getElementById('years-range').classList.toggle('hidden', selectedValue !== 'years');
    document.getElementById('months-range').classList.toggle('hidden', selectedValue !== 'months');
    resetValueFilters();
});

function createChartReportVisit() {
    const report_type = document.getElementById('report-period').value;
    let from = "";
    let to = "";
    let reference = "";
    switch (report_type) {
        case 'years':
            // Logica per il report annuale
            from = document.getElementById('from-year').value;
            to = document.getElementById('to-year').value;
            break;
        case 'months':
            // Logica per il report mensile
            from = document.getElementById('from-month').value;
            to = document.getElementById('to-month').value;
            reference = document.getElementById('reference-year').value;
            break;
        default:
            // Logica per il report predefinito
            break;
    }
    fetch('/dashboard/chartVisits', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            // any necessary data to send to the server
            type: report_type,
            from: from,
            to: to,
            reference: reference
        })
    })
    .then(res => res.json())
    .then(chartData => {
        createChart(chartData.labels, chartData.datasets);
    });
}

function createChart(label, datasets){
    document.getElementById('visits-report-chart-container').classList.remove('hidden');
    // Controlla se il tipo di grafico è torta o ciambella per configurare la legenda
    const ctx = document.getElementById('visits-report-chart').getContext('2d');

    if (currentReportChart) {
        currentReportChart.destroy();
    }

    const config = {
            type: 'bar',
            
            data: {
                labels: label,
                datasets: datasets
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Visite per anno e genere'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    },
                },
                interaction: {
                    mode: 'nearest',
                    axis: 'x',
                    intersect: false
                },
                scales: {
                    x: {
                        stacked: false
                    },
                    y: {
                        beginAtZero: true,
                        stacked: false
                    }
                }
            }
        };

    currentReportChart = new Chart(ctx, config);
}
