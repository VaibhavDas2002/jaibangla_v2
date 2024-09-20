<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    FAQController,
    PolicyController,
    UserManualController,
    EntryFormController,
    reportController
};


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// Policy routes
Route::get('copyright-policy', [PolicyController::class, 'copyright'])->name('copyright-policy');
Route::get('privacy-policy', [PolicyController::class, 'privacy'])->name('privacy-policy');
Route::get('hyperlink-policy', [PolicyController::class, 'hyperlink'])->name('hyperlink-policy');
Route::get('terms-policy', [PolicyController::class, 'terms_condition'])->name('terms-policy');

// Frequently Asked Questions
Route::get('faq', [FAQController::class, 'index'])->name('faq');

// User Manual
Route::any('upload-user-manual', [UserManualController::class, 'upload']);
Route::get('get-user-manual', [UserManualController::class, 'get'])->name('get-user-manual');
Route::get('download_user_manual', [UserManualController::class, 'downloadstaticpdf']);


// Entry Form
Route::get('entryformoption', [EntryFormController::class, 'SelectScheme']);
Route::get('formEntry', [EntryFormController::class, 'FormEntry'])->name('formEntry');













// SelectReport
//
Route::get('gotoReport', [reportController::class, 'SelectReport'])->name('SelectReport');
Route::post('report_search', [reportController::class, 'report_search'])->name('report_search');
