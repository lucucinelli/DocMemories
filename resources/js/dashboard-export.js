document.getElementById('export_file').addEventListener('change', function(){
    const valueSelected = this.value;
    switch(valueSelected) { 
        case 'visits':
            document.getElementById('export_button_visits').classList.remove('hidden');
            document.getElementById('export_button_patients').classList.add('hidden');
            document.getElementById('export_button_physiological_histories').classList.add('hidden');
            document.getElementById('export_button_familiar_histories').classList.add('hidden');
            document.getElementById('export_button_remote_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_next_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_medicinals').classList.add('hidden');
            document.getElementById('export_button_tests').classList.add('hidden');
            document.getElementById('export_button_exams').classList.add('hidden');
            break;
        case 'physiologicalHistories':
            document.getElementById('export_button_physiological_histories').classList.remove('hidden');
            document.getElementById('export_button_patients').classList.add('hidden');
            document.getElementById('export_button_visits').classList.add('hidden');
            document.getElementById('export_button_familiar_histories').classList.add('hidden');
            document.getElementById('export_button_remote_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_next_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_medicinals').classList.add('hidden');
            document.getElementById('export_button_tests').classList.add('hidden');
            document.getElementById('export_button_exams').classList.add('hidden');
            break;
        case 'familiarHistories':
            document.getElementById('export_button_familiar_histories').classList.remove('hidden');
            document.getElementById('export_button_patients').classList.add('hidden');
            document.getElementById('export_button_visits').classList.add('hidden');
            document.getElementById('export_button_physiological_histories').classList.add('hidden');
            document.getElementById('export_button_remote_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_next_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_medicinals').classList.add('hidden');
            document.getElementById('export_button_tests').classList.add('hidden');
            document.getElementById('export_button_exams').classList.add('hidden');
            break;
        case 'remotePathologicalHistories':
            document.getElementById('export_button_remote_pathological_histories').classList.remove('hidden');
            document.getElementById('export_button_patients').classList.add('hidden');
            document.getElementById('export_button_visits').classList.add('hidden');
            document.getElementById('export_button_physiological_histories').classList.add('hidden');
            document.getElementById('export_button_familiar_histories').classList.add('hidden');
            document.getElementById('export_button_next_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_medicinals').classList.add('hidden');
            document.getElementById('export_button_tests').classList.add('hidden');
            document.getElementById('export_button_exams').classList.add('hidden');
            break;
        case 'nextPathologicalHistories':
            document.getElementById('export_button_next_pathological_histories').classList.remove('hidden');
            document.getElementById('export_button_patients').classList.add('hidden');
            document.getElementById('export_button_visits').classList.add('hidden');
            document.getElementById('export_button_physiological_histories').classList.add('hidden');
            document.getElementById('export_button_familiar_histories').classList.add('hidden');
            document.getElementById('export_button_remote_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_medicinals').classList.add('hidden');
            document.getElementById('export_button_tests').classList.add('hidden');
            document.getElementById('export_button_exams').classList.add('hidden');
            break;
        case 'medicinals':
            document.getElementById('export_button_medicinals').classList.remove('hidden');
            document.getElementById('export_button_patients').classList.add('hidden');
            document.getElementById('export_button_visits').classList.add('hidden');
            document.getElementById('export_button_physiological_histories').classList.add('hidden');
            document.getElementById('export_button_familiar_histories').classList.add('hidden');
            document.getElementById('export_button_remote_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_next_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_tests').classList.add('hidden');
            document.getElementById('export_button_exams').classList.add('hidden');
            break;
        case 'tests':
            document.getElementById('export_button_tests').classList.remove('hidden');
            document.getElementById('export_button_patients').classList.add('hidden');
            document.getElementById('export_button_visits').classList.add('hidden');
            document.getElementById('export_button_physiological_histories').classList.add('hidden');
            document.getElementById('export_button_familiar_histories').classList.add('hidden');
            document.getElementById('export_button_remote_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_next_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_medicinals').classList.add('hidden');
            document.getElementById('export_button_exams').classList.add('hidden');
            break;
        case 'exams':
            document.getElementById('export_button_exams').classList.remove('hidden');
            document.getElementById('export_button_patients').classList.add('hidden');
            document.getElementById('export_button_visits').classList.add('hidden');
            document.getElementById('export_button_physiological_histories').classList.add('hidden');
            document.getElementById('export_button_familiar_histories').classList.add('hidden');
            document.getElementById('export_button_remote_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_next_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_medicinals').classList.add('hidden');
            document.getElementById('export_button_tests').classList.add('hidden');
            break;
        default:
            document.getElementById('export_button_patients').classList.remove('hidden');
            document.getElementById('export_button_visits').classList.add('hidden');
            document.getElementById('export_button_physiological_histories').classList.add('hidden');
            document.getElementById('export_button_familiar_histories').classList.add('hidden');
            document.getElementById('export_button_remote_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_next_pathological_histories').classList.add('hidden');
            document.getElementById('export_button_medicinals').classList.add('hidden');
            document.getElementById('export_button_tests').classList.add('hidden');
            document.getElementById('export_button_exams').classList.add('hidden');
            break;
    }
})