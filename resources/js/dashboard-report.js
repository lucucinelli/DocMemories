// Menù of reports - dashboard page 
resetReportFilters();   
let currentReportChart = null;
let currentReportChartIn = null;

document.getElementById('patients-tab').addEventListener('click', function() {
    document.getElementById('patients-report').classList.remove('hidden');
    document.getElementById('visits-report').classList.add('hidden');
    document.getElementById('reservations-report').classList.add('hidden');
    document.getElementById('tabs').value = 'Patients';
    createChartReport('patients');
});

document.getElementById('visits-tab').addEventListener('click', function() {
    document.getElementById('patients-report').classList.add('hidden');
    document.getElementById('visits-report').classList.remove('hidden');
    document.getElementById('reservations-report').classList.add('hidden');
    document.getElementById('tabs').value = 'Visits';
    createChartReport('visits');
});

document.getElementById('reservations-tab').addEventListener('click', function() {
    document.getElementById('patients-report').classList.add('hidden');
    document.getElementById('visits-report').classList.add('hidden');
    document.getElementById('reservations-report').classList.remove('hidden');
    document.getElementById('tabs').value = 'Reservations';
    createChartReportReservations();
});

document.getElementById('tabs').addEventListener('change', function() {
    const selectedValue = this.value;
    document.getElementById('patients-report').classList.toggle('hidden', selectedValue !== 'Patients');
    document.getElementById('visits-report').classList.toggle('hidden', selectedValue !== 'Visits');
    document.getElementById('reservations-report').classList.toggle('hidden', selectedValue !== 'Reservations');
    createChartReport(selectedValue.toLowerCase());
});

function resetReportFilters() {
    document.getElementById('tabs').value = '';
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


// Charts for patients, visits and reservations

function createChartReport(button) {
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
    fetch('/dashboard/chart', {
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
            reference: reference,
            button: button,
        })
    })
    .then(res => res.json())
    .then(chartData => {
        createChart(chartData.labels, chartData.datasets, button);
    });
}

function createChartReportReservations(){
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
    fetch('/dashboard/chartReservations', {
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
            reference: reference,
        })
    })
    .then(res => res.json())
    .then(chartData => {
        createChartReservations(chartData.labelsIs, chartData.labelsIn, chartData.datasetsIs, chartData.datasetsIn);
    });
}

function createChart(label, datasets, refers){
    document.getElementById(refers + '-report-chart-container').classList.remove('hidden');
    // Controlla se il tipo di grafico è torta o ciambella per configurare la legenda
    const ctx = document.getElementById(refers + '-report-chart').getContext('2d');
    let title = '';
    if (refers === 'patients') {
        title = 'Report dei pazienti';
    } else if (refers === 'visits') {
        title = 'Report delle visite';
    }

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
                        text: title,
                        font: {
                            size: 20,
                            family: 'sans-serif',
                            weight: 'bold',
                            color: '#000'
                        }
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

function createChartReservations(labelIs, labelIn, datasetsIs, datasetsIn){
    document.getElementById('reservationIs-report-chart-container').classList.remove('hidden');
    document.getElementById('reservationIn-report-chart-container').classList.remove('hidden');
    // Controlla se il tipo di grafico è torta o ciambella per configurare la legenda
    const ctxIs = document.getElementById('reservationIs-report-chart').getContext('2d');
    const ctxIn = document.getElementById('reservationIn-report-chart').getContext('2d');

    let title = 'Report delle prenotazioni';

    if (currentReportChart) {
        currentReportChart.destroy();
    }
    if (currentReportChartIn) {
        currentReportChartIn.destroy();
    }

    const configIs = {
            type: 'bar',
            
            data: {
                labels: labelIs,
                datasets: datasetsIs
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: title,
                        font: {
                            size: 20,
                            family: 'sans-serif',
                            weight: 'bold',
                            color: '#000'
                        }
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

        const configIn = {
            type: 'bar',
            
            data: {
                labels: labelIn,
                datasets: datasetsIn
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: title,
                        font: {
                            size: 20,
                            family: 'sans-serif',
                            weight: 'bold',
                            color: '#000'
                        }
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


    currentReportChart = new Chart(ctxIs, configIs);
    currentReportChartIn = new Chart(ctxIn, configIn);
}