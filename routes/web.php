<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ApplicationDataController;
use App\Http\Controllers\ClientComtroller;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MedicianeMst;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PractitionerController;
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

Route::group(["middleware" => 'auth'], function () {
    Route::get('change_password', [AdminAuthController::class, 'change_password'])->name('change_password');
    Route::get('logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard');

    Route::get('medicine_list', [MedicianeMst::class, 'medicine_list'])->name('medicine_list');
    Route::get('users', [UserController::class, 'user_list'])->name('users');

    Route::get('patient_list', [PatientController::class, 'patient_list'])->name('patient_list');

    Route::get('application_data', [ApplicationDataController::class, 'application_data'])->name('application_data');
    Route::get('showFormDetails/{id}', [ApplicationDataController::class, 'showFormDetails'])->name('showFormDetails');

    Route::get('practitioners_list', [PractitionerController::class, 'practitioners_list'])->name('practitioners_list');
    Route::get('add_practitioner', [PractitionerController::class, 'add_practitioner'])->name('add_practitioner');
    Route::post('add_practitioner_action', [PractitionerController::class, 'add_practitioner_action'])->name('add_practitioner_action');
    Route::get('download_sample_excel', [PractitionerController::class, 'download_sample_excel'])->name('download_sample_excel');
    Route::post('upload_practitioner_excel', [PractitionerController::class, 'upload_practitioner_excel'])->name('upload_practitioner_excel');
    Route::get('edit_practitioner/{id}', [PractitionerController::class, 'edit_practitioner'])->name('edit_practitioner');
    Route::post('update_practitioner/{id}', [PractitionerController::class, 'update_practitioner'])->name('update_practitioner');
    Route::get('/get-districts/{sid}', [PractitionerController::class, 'get_districts'])->name('get_districts');
    Route::get('/practitioners/filter', [PractitionerController::class, 'practitioner_filter'])->name('practitioner_filter');

    Route::get('/export-practitioners', [PractitionerController::class, 'export_practitioners'])->name('export_practitioners');

    //Notice route
    Route::get('/notice_list', [NoticeController::class, 'notice_list'])->name('notice_list');
    Route::get('/add_notice', [NoticeController::class, 'add_notice'])->name('add_notice');
    Route::post('/add_notice_action', [NoticeController::class, 'add_notice_action'])->name('add_notice_action');
    Route::get('/edit-notice/{id}', [NoticeController::class, 'edit_notice'])->name('edit_notice');
    Route::post('/update-notice', [NoticeController::class, 'update_notice'])->name('update_notice');
    Route::post('/notice-filter', [NoticeController::class, 'notice_filter'])->name('notice_filter');
    Route::get('/notice-file-delete/{id}', [NoticeController::class, 'notice_file_delete'])->name('notice_file_delete');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AdminAuthController::class, 'admin_login'])->name('login');
    Route::post('/admin-login-action', [AdminAuthController::class, 'admin_login_action'])->name('admin_login_action');
});
