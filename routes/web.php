<?php

use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedicinalController; 
use App\Http\Controllers\FamiliarHistoryController;
use App\Http\Controllers\PhysiologicalHistoryController;
use App\Http\Controllers\NextPathologicalHistoryController;
use App\Http\Controllers\RemotePathologicalHistoryController;

// welcome page

Route::get('/', function () {
    return view('welcome');
});

// dashboard and profile routes
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/dashboard/chart', [DashboardController::class, 'chart'])->middleware(['auth', 'verified'])->name('dashboard.chart');
Route::post('/dashboard/chartReservations', [DashboardController::class, 'chartReservations'])->middleware(['auth', 'verified'])->name('dashboard.chartReservations');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// analytics
Route::get('/analytics', function () {
    return view('analytics');
})->middleware(['auth', 'verified'])->name('analytics');

require __DIR__.'/auth.php';

/**------------------------------------------------------- PATIENTS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/patients', [PatientController::class, 'showPatients'])->name('showPatients'); // List all patients
    Route::get('/showPatient/{patient}', [PatientController::class, 'showPatient'])->name('showPatient')->middleware(CheckUser::class); // Show information about a specific patient
    Route::post('/createPatient', [PatientController::class, 'newPatient'])->name('newPatient'); // Create a new patient
    Route::match(['GET', 'POST'],'/searchPatient', [PatientController::class, 'searchPatient'])->name('searchPatient'); // Search a new patient
    Route::put('/editPatient/{patient}', [PatientController::class, 'editPatient'])->name('editPatient')->middleware(CheckUser::class);; // Edit an existing patient
    Route::delete('/deletePatient/{patient}', [PatientController::class, 'deletePatient'])->name('deletePatient')->middleware(CheckUser::class);; // Delete an existing patient

    Route::get('/newPatient', [PatientController::class, 'newPatientForm'])->name('newPatientForm'); // Show form to create a new patient
    Route::get('/exportPatients', [PatientController::class, 'exportPatients'])->name('exportPatients'); // Export patients to CSV
});
/**--------------------------------------------------------- VISITS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/visits/{patient?}', [VisitController::class, 'showVisits'])->name('showVisits'); // List all visits
    Route::get('/showVisits/{visit}', [VisitController::class, 'showVisit'])->name('showVisit');  // Show information about a specific visit
    Route::post('/createVisit/{patient}', [VisitController::class, 'newVisit'])->name('newVisit')->middleware(CheckUser::class); // Create a new visit for a patient
    Route::put('/editVisit/{visit}', [VisitController::class, 'editVisit'])->name('editVisit');  // Edit an existing visit
    Route::delete('/deleteVisit/{visit}', [VisitController::class, 'deleteVisit'])->name('deleteVisit'); // Delete an existing visit

    Route::get('/newVisit/{patient}', [VisitController::class, 'newVisitForm'])->name('newVisitForm')->middleware(CheckUser::class); // Show form to create a new visit for a patient
    Route::match(['GET', 'POST'],'/searchVisits', [VisitController::class, 'searchVisits'])->name('searchVisits'); // Search for visits
    Route::get('/exportVisits', [VisitController::class, 'exportVisits'])->name('exportVisits'); // Export visits to CSV
    Route::get('/dailyReportVisits', [VisitController::class, 'dailyReportVisits'])->name('dailyReportVisits'); // Show visits report
    Route::get('/weeklyReportVisits', [VisitController::class, 'weeklyReportVisits'])->name('weeklyReportVisits'); // Show visits report
    Route::get('/monthlyReportVisits', [VisitController::class, 'monthlyReportVisits'])->name('monthlyReportVisits'); // Show visits report
    Route::get('/annualReportVisits', [VisitController::class, 'annualReportVisits'])->name('annualReportVisits'); // Show visits report
    Route::get('/dailyReportReservations/{type}', [VisitController::class, 'dailyReportReservations'])->name('dailyReportReservations'); // Show visits report
    Route::get('/weeklyReportReservations/{type}', [VisitController::class, 'weeklyReportReservations'])->name('weeklyReportReservations'); // Show visits report
    Route::get('/monthlyReportReservations/{type}', [VisitController::class, 'monthlyReportReservations'])->name('monthlyReportReservations'); // Show visits report
    Route::get('/annualReportReservations/{type}', [VisitController::class, 'annualReportReservations'])->name('annualReportReservations'); // Show visits report
});
/**-------------------------------------------------------- MEDICINALS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/createMedicinal/{visit}', [MedicinalController::class, 'newMedicinal'])->name('newMedicinal'); // Create a new medicinal
    Route::put('/editMedicinal/{medicinal}', [MedicinalController::class, 'editMedicinal'])->name('editMedicinal'); // Edit an existing medicinal
    Route::delete('/deleteMedicinal/{medicinal}', [MedicinalController::class, 'deleteMedicinal'])->name('deleteMedicinal'); // Delete an existing medicinal
    Route::get('/exportMedicinals', [MedicinalController::class, 'exportMedicinals'])->name('exportMedicinals'); // Export medicinals to CSV
});
/**--------------------------------------------------------- TESTS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/createTest/{visit}', [TestController::class, 'newTest'])->name('newTest'); // Create a new test
    Route::put('/editTest/{test}', [TestController::class, 'editTest'])->name('editTest'); // Edit an existing test
    Route::delete('/deleteTest/{test}', [TestController::class, 'deleteTest'])->name('deleteTest'); // Delete an existing test
    Route::get('/exportTests', [TestController::class, 'exportTests'])->name('exportTests'); // Export tests to CSV
});
/**--------------------------------------------------------- EXAMS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/createExam/{visit}', [ExamController::class, 'newExam'])->name('newExam'); // Create a new exam
    Route::put('/editExam/{exam}', [ExamController::class, 'editExam'])->name('editExam'); // Edit an existing exam
    Route::delete('/deleteExam/{exam}', [ExamController::class, 'deleteExam'])->name('deleteExam'); // Delete an existing exam
    Route::get('/exportExams', [ExamController::class, 'exportExams'])->name('exportExams'); // Export exams to CSV

    // Exam file management
    Route::get('/viewExamFile/{exam}', [ExamController::class, 'viewExamFile'])->name('viewExamFile'); // View the file of an exam
    Route::post('/uploadExamFile/{exam}', [ExamController::class, 'uploadExamFile'])->name('uploadExamFile'); // Upload a file for an exam
    Route::post('/replaceExamFile/{exam}', [ExamController::class, 'replaceExamFile'])->name('replaceExamFile'); // Replace the file of an exam
    Route::delete('/deleteExamFile/{exam}', [ExamController::class, 'deleteExamFile'])->name('deleteExamFile'); // Delete the file of an exam
});
/**--------------------------------------------------------- HISTORIES CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/showHistory/{patient}', [HistoryController::class, 'show'])->name('showHistory')->middleware(CheckUser::class); // Show information about a specific history
});

/**--------------------------------------------------------- FAMILIAR HISTORIES -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/createFamiliarHistory/{patient}', [FamiliarHistoryController::class, 'newFamiliarHistory'])->name('newFamiliarHistory')->middleware(CheckUser::class); // Create a new familiar history
    Route::put('/editFamiliarHistory/{familiarHistory}', [FamiliarHistoryController::class, 'editFamiliarHistory'])->name('editFamiliarHistory'); // Edit an existing familiar history
    Route::delete('/deleteFamiliarHistory/{familiarHistory}', [FamiliarHistoryController::class, 'deleteFamiliarHistory'])->name('deleteFamiliarHistory'); // Delete an existing familiar history
    Route::get('/exportFamiliarHistories', [FamiliarHistoryController::class, 'exportFamiliarHistories'])->name('exportFamiliarHistories'); // Export familiar histories to CSV
});

/**--------------------------------------------------------- REMOTE PATHOLOGICAL HISTORIES -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/createRemotePathologicalHistory/{patient}', [RemotePathologicalHistoryController::class, 'newRemotePathologicalHistory'])->name('newRemotePathologicalHistory')->middleware(CheckUser::class); // Create a new remote pathological history
    Route::put('/editRemotePathologicalHistory/{remotePathologicalHistory}', [RemotePathologicalHistoryController::class, 'editRemotePathologicalHistory'])->name('editRemotePathologicalHistory'); // Edit an existing remote pathological history
    Route::delete('/deleteRemotePathologicalHistory/{remotePathologicalHistory}', [RemotePathologicalHistoryController::class, 'deleteRemotePathologicalHistory'])->name('deleteRemotePathologicalHistory'); // Delete an existing remote pathological history
    Route::get('/exportRemotePathologicalHistories', [RemotePathologicalHistoryController::class, 'exportRemotePathologicalHistories'])->name('exportRemotePathologicalHistories'); // Export pathological histories to CSV
});
/**--------------------------------------------------------- NEXT PATHOLOGICAL HISTORIES -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/createNextPathologicalHistory/{patient}', [NextPathologicalHistoryController::class, 'newNextPathologicalHistory'])->name('newNextPathologicalHistory')->middleware(CheckUser::class); // Create a new next pathological history
    Route::put('/editNextPathologicalHistory/{nextPathologicalHistory}', [NextPathologicalHistoryController::class, 'editNextPathologicalHistory'])->name('editNextPathologicalHistory'); // Edit an existing next pathological history
    Route::delete('/deleteNextPathologicalHistory/{nextPathologicalHistory}', [NextPathologicalHistoryController::class, 'deleteNextPathologicalHistory'])->name('deleteNextPathologicalHistory'); // Delete an existing next pathological history
    Route::get('/exportNextPathologicalHistories', [NextPathologicalHistoryController::class, 'exportNextPathologicalHistories'])->name('exportNextPathologicalHistories'); // Export next pathological histories to CSV
});
/**--------------------------------------------------------- PHYSIOLOGICAL HISTORIES -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/isPhysiologicalHistorySet/{patient}', [PhysiologicalHistoryController::class, 'isPhysiologicalHistorySet'])->name('isPhysiologicalHistorySet')->middleware(CheckUser::class); // Check if physiological history is set
    Route::post('/createPhysiologicalHistory/{patient}', [PhysiologicalHistoryController::class, 'newPhysiologicalHistory'])->name('newPhysiologicalHistory')->middleware(CheckUser::class); // Create a new physiological history
    Route::put('/editPhysiologicalHistory/{patient}', [PhysiologicalHistoryController::class, 'editPhysiologicalHistory'])->name('editPhysiologicalHistory')->middleware(CheckUser::class); // Edit an existing physiological history
    Route::get('/exportPhysiologicalHistories', [PhysiologicalHistoryController::class, 'exportPhysiologicalHistories'])->name('exportPhysiologicalHistories'); // Export physiological histories to CSV
});
/**--------------------------------------------------------- ANALYTICS  -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/analytics/countOfPatients', [AnalyticsController::class, 'numberOfPatients'])->name('analytics.countOfPatients'); // Get number of patients
    Route::post('/analytics/patology', [AnalyticsController::class, 'analyzedPatology'])->name('analytics.patology'); // Get patology data
    Route::post('/analytics/persChart', [AnalyticsController::class, 'persChart'])->name('analytics.persChart'); // Get age data
});


