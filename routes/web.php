<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ApplicationDataController;
use App\Http\Controllers\ClientComtroller;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MedicianeMst;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Livewire\CheckoutModule;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', [HomeController::class, 'index'])->name('home_page');
Route::get('about-us', [HomeController::class, 'about_us'])->name('about_us');
Route::get('contact-us', [HomeController::class, 'contact_us'])->name('contact_us');
Route::get('services', [HomeController::class, 'services'])->name('services');
Route::get('portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
Route::get('portfolio/{slug}', [HomeController::class, 'portfolio_details'])->name('portfolio_details');
Route::get('generate_certificate/{id}', [HomeController::class, 'generate_certificate'])->name('generate_certificate');
Route::get('generate_certificate_2/{id}', [HomeController::class, 'generate_certificate_2'])->name('generate_certificate_2');

Route::group(["middleware" => 'auth'], function(){
    Route::get('change_password', [AdminAuthController::class, 'change_password'])->name('change_password');
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

    Route::get('medicine_list', [MedicianeMst::class, 'medicine_list'])->name('medicine_list');
    Route::get('users', [UserController::class, 'user_list'])->name('users');

    Route::get('patient_list', [PatientController::class, 'patient_list'])->name('patient_list');

    Route::get('application_data', [ApplicationDataController::class, 'application_data'])->name('application_data');
    Route::get('showFormDetails/{id}', [ApplicationDataController::class, 'showFormDetails'])->name('showFormDetails');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AdminAuthController::class, 'admin_login'])->name('login');
    Route::post('/admin-login-action', [AdminAuthController::class, 'admin_login_action'])->name('admin_login_action');
});
