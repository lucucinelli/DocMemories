<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TherapyController;
use App\Http\Controllers\MedicineController;

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

    Route::get('/newVisit/{patient?}', [VisitController::class, 'newVisitForm'])->name('newVisitForm'); // Show form to create a new visit for a patient
    Route::post('/searchVisits', [VisitController::class, 'searchVisits'])->name('searchVisits'); // Search for visits
});

/**--------------------------------------------------------- THERAPIES CRUD-------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/therapies', [TherapyController::class, 'showTherapies'])->name('showTherapies'); // List all therapies
    Route::get('/showTherapy/{therapy}', [TherapyController::class, 'showTherapy'])->name('showTherapy'); // Show information about a specific therapy
});


/**-------------------------------------------------------- MEDICINALS CRUD -------------------------------------------------------------- */
Route::middleware('auth')->group(function () {
    Route::get('/medicinals', [MedicineController::class, 'showMedicinals'])->name('showMedicinals'); // List all medicinals
    Route::get('/showMedicinal/{medicinal}', [MedicineController::class, 'showMedicinal'])->name('showMedicinal'); // Show information about a specific medicinal
    Route::post('/createMedicinal', [MedicineController::class, 'newMedicinal'])->name('newMedicinal'); // Create a new medicinal
    Route::put('/editMedicinal/{medicinal}', [MedicineController::class, 'editMedicinal'])->name('editMedicinal'); // Edit an existing medicinal
    Route::delete('/deleteMedicinal/{medicina}', [MedicineController::class, 'deleteMedicinal'])->name('deleteMedicinal'); // Delete an existing medicinal
});
