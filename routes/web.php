<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AssignRoleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication
Auth::routes();

// Dashboard
Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard.index');
});

// Users
Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'index')->name("users.index");
    Route::get('/users/create', 'create')->name("users.create");
    Route::post('/users', 'store')->name("users.store");
    Route::get('/users/{id}', 'show')->name("users.show");
    Route::get('/users/{id}/edit', 'edit')->name("users.edit");
    Route::put('/users/{id}/edit', 'update')->name("users.update");
    Route::delete('/users/{id}', 'destroy')->name("users.destroy");
});

// Prospects
Route::controller(ProspectController::class)->group(function () {
    Route::get('/prospects', 'index')->name("prospects.index");
    Route::get('/prospects/create', 'create')->name("prospects.create");
    Route::post('/prospects', 'store')->name("prospects.store");
    Route::get('/prospects/{id}', 'show')->name("prospects.show");
    Route::get('/prospects/{id}/edit', 'edit')->name("prospects.edit");
    Route::put('/prospects/{id}/edit', 'update')->name("prospects.update");
    Route::delete('/prospects/{id}', 'destroy')->name("prospects.destroy");
});

// Customers
Route::controller(CustomerController::class)->group(function () {
    Route::get('/customers', 'index')->name("customers.index");
    Route::get('/customers/{id}', 'show')->name("customers.show");
    Route::delete('/customers/{edit}', 'destroy')->name("customers.destroy");
});

// Appointments
Route::controller(AppointmentController::class)->group(function () {
    Route::get('/appointments', 'index')->name('appointments.index');
    Route::get('/appointments/create', 'create')->name('appointments.create');
    Route::post('/appointments', 'store')->name('appointments.store');
    Route::get('/appointments/{id}', 'show')->name('appointments.show');
    Route::get('/appointments/{id}/edit', 'edit')->name('appointments.edit');
    Route::put('/appointments/{id}/edit', 'update')->name('appointments.update');
    Route::delete('/appointments/{id}', 'destroy')->name('appointments.destroy');
});

// Report
Route::controller(ReportController::class)->group(function () {
    Route::get('/report/pdf', 'pdfReport')->name('pdf-report');
    Route::get('/report/excel', 'excelReport')->name('excel-report');
});

// PDF
Route::controller(PDFController::class)->group(function () {
    Route::get('/report/users/pdf', 'allUsers')->name('users-pdf');
    Route::get('/report/prospects/pdf', 'allProspects')->name('prospects-pdf');
    Route::get('/report/customers/pdf', 'allCustomers')->name('customers-pdf');
    Route::get('/report/appointments/pdf', 'allAppointments')->name('appointments-pdf');
});

// Excel
Route::controller(ExcelController::class)->group(function () {
    Route::get('/report/users/excel', 'allUsers')->name("users-excel");
    Route::get('/report/prospects/excel', 'allProspects')->name("prospects-excel");
    Route::get('/report/customers/excel', 'allCustomers')->name("customers-excel");
    Route::get('/report/appointments/excel', 'allAppointments')->name("appointments-excel");
});

// Roles
Route::controller(RoleController::class)->group(function () {
    Route::get('administration/roles', 'index')->name("roles.index");
    Route::get('administration/roles/create', 'create')->name("roles.create");
    Route::post('administration/roles', 'store')->name("roles.store");
    Route::get('administration/roles/{id}', 'show')->name("roles.show");
    Route::get('administration/roles/{id}/edit', 'edit')->name("roles.edit");
    Route::put('administration/roles/{id}/edit', 'update')->name("roles.update");
    Route::delete('administration/roles/{id}', 'destroy')->name("roles.destroy");
});

// Assign Roles
Route::controller(AssignRoleController::class)->group(function () {
    Route::get('administration/assign-roles', 'index')->name("assign.roles.index");
    Route::get('administration/assign-roles/create', 'create')->name("assign.roles.create");
    Route::post('administration/assign-roles', 'store')->name("assign.roles.store");
    Route::get('administration/assign-roles/{id}/edit', 'edit')->name("assign.roles.edit");
    Route::put('administration/assign-roles/{id}/edit', 'update')->name("assign.roles.update");
    Route::delete('administration/assign-roles/{id}', 'destroy')->name("assign.roles.destroy");
});
