<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::post('/import-report',[HomeController::class, 'import'])->name('import-report');

Route::resource('reports', ReportController::class);


Route::get('reports/download/invoice/{id}', [ReportController::class, 'downloadPdf'])->name('reports.download');

// Route::get('reports/download/invoice/{id}', [ReportController::class, 'printPdf'])->name('reports.download');


