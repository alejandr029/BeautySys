<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Main Page Route

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\RoleAssignmentController; // Asegúrate de importar correctamente el controlador local


Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

//Route::view('/dashboard', 'layout.tamplated')->name('dashboard');
Route::view('/dashboard','dashboard')->name('dashboard');


Route::view('/tables','tables')->name('tables');
Route::view('/Inventario','Inventario.inventario')->name('inventario');

Route::view('/profile','profile')->name('profile');

// Ruta para mostrar el formulario de asignación de roles
Route::get('/assign-roles', [RoleAssignmentController::class, 'index'])->name('assign-roles.index');

// Ruta para procesar el formulario de asignación de roles
Route::post('/assign-roles', [RoleAssignmentController::class, 'assign'])->name('assign-roles.assign');
