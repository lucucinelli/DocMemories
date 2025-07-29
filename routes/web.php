<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MedicinalController; 
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\FamiliarHistoryController;


// welcome page

Route::get('/', function () {
    return view('welcome');
});

// dashboard and profile routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/**------------------------------------------------------- PATIENTS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/patients', [PatientController::class, 'showPatients'])->name('showPatients'); // List all patients
    Route::get('/showPatient/{patient}', [PatientController::class, 'showPatient'])->name('showPatient'); // Show information about a specific patient
    Route::post('/createPatient', [PatientController::class, 'newPatient'])->name('newPatient'); // Create a new patient
    Route::post('/searchPatient', [PatientController::class, 'searchPatient'])->name('searchPatient'); // Search a new patient
    Route::put('/editPatient/{patient}', [PatientController::class, 'editPatient'])->name('editPatient'); // Edit an existing patient
    Route::delete('/deletePatient/{patient}', [PatientController::class, 'deletePatient'])->name('deletePatient'); // Delete an existing patient

    Route::get('/newPatient', [PatientController::class, 'newPatientForm'])->name('newPatientForm'); // Show form to create a new patient
});
/**--------------------------------------------------------- VISITS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/visits', [VisitController::class, 'showVisits'])->name('showVisits'); // List all visits
    Route::get('/showVisits/{visit}', [VisitController::class, 'showVisit'])->name('showVisit');  // Show information about a specific visit
    Route::post('/createVisit/{patient}', [VisitController::class, 'newVisit'])->name('newVisit'); // Create a new visit for a patient
    Route::put('/editVisit/{visit}', [VisitController::class, 'editVisit'])->name('editVisit');  // Edit an existing visit
    Route::delete('/deleteVisit/{visit}', [VisitController::class, 'deleteVisit'])->name('deleteVisit'); // Delete an existing visit

    Route::get('/newVisit/{patient}', [VisitController::class, 'newVisitForm'])->name('newVisitForm'); // Show form to create a new visit for a patient
    Route::post('/searchVisits', [VisitController::class, 'searchVisits'])->name('searchVisits'); // Search for visits
});
/**-------------------------------------------------------- MEDICINALS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/createMedicinal/{visit}', [MedicinalController::class, 'newMedicinal'])->name('newMedicinal'); // Create a new medicinal
    Route::put('/editMedicinal/{medicinal}', [MedicinalController::class, 'editMedicinal'])->name('editMedicinal'); // Edit an existing medicinal
    Route::delete('/deleteMedicinal/{medicinal}', [MedicinalController::class, 'deleteMedicinal'])->name('deleteMedicinal'); // Delete an existing medicinal
});
/**--------------------------------------------------------- TESTS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/createTest/{visit}', [TestController::class, 'newTest'])->name('newTest'); // Create a new test
    Route::put('/editTest/{test}', [TestController::class, 'editTest'])->name('editTest'); // Edit an existing test
    Route::delete('/deleteTest/{test}', [TestController::class, 'deleteTest'])->name('deleteTest'); // Delete an existing test
});
/**--------------------------------------------------------- EXAMS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/createExam/{visit}', [ExamController::class, 'newExam'])->name('newExam'); // Create a new exam
    Route::put('/editExam/{exam}', [ExamController::class, 'editExam'])->name('editExam'); // Edit an existing exam
    Route::delete('/deleteExam/{exam}', [ExamController::class, 'deleteExam'])->name('deleteExam'); // Delete an existing exam
});
/**--------------------------------------------------------- HISTORIES CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/showHistory/{patient}', [HistoryController::class, 'show'])->name('showHistory'); // Show information about a specific history
});

/**--------------------------------------------------------- FAMILIAR HISTORIES -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::post('/createFamiliarHistory/{patient}', [FamiliarHistoryController::class, 'newFamiliarHistory'])->name('newFamiliarHistory'); // Create a new familiar history
    Route::put('/editFamiliarHistory/{familiarHistory}', [FamiliarHistoryController::class, 'editFamiliarHistory'])->name('editFamiliarHistory'); // Edit an existing familiar history
    Route::delete('/deleteFamiliarHistory/{familiarHistory}', [FamiliarHistoryController::class, 'deleteFamiliarHistory'])->name('deleteFamiliarHistory'); // Delete an existing familiar history
});