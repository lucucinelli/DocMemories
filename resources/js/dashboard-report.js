// Menù of reports - dashboard page 

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