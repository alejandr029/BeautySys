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
use App\Http\Controllers\AsignarRolController; // Asegúrate de importar correctamente el controlador local
use App\Http\Controllers\CuentasController;
use App\Http\Controllers\InventarioInsumoController;
use App\Http\Controllers\InventarioEquipoMedicoController;
use App\Http\Controllers\ProveedorController;




Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::get('/registro', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/registro', [RegisteredUserController::class, 'store'])->middleware('guest');

//Route::view('/dashboard', 'layout.template')->name('dashboard');
Route::view('/dashboard','dashboard')->name('dashboard');
Route::view('/tables','tables')->name('tables');

// CUENTAS
Route::get('/cuentas', [CuentasController::class,'index'])->name('Cuentas.index');
Route::get('/crear/cuenta', [CuentasController::class,'create'])->name('Cuentas.crear');
Route::post('/crear/cuenta', [CuentasController::class, 'store'])->name('Cuentas.store');
Route::get('/cuentas/id={id}/editar', [CuentasController::class, 'edit'])->name('Cuentas.edit');
Route::put('/cuentas/id={id}/actualizar', [CuentasController::class, 'update'])->name('Cuentas.update');
Route::get('/cuentas/{id}/eliminar', [CuentasController::class, 'destroyForm'])->name('Cuentas.eliminar');
Route::post('/cuentas/{id}', [CuentasController::class, 'destroy'])->name('Cuentas.destroy');
Route::get('/cuentas/id={id}/visualizar', [CuentasController::class, 'show'])->name('Cuentas.visualizar');

//INVENTARIO INSUMOS
Route::get('/Inventario', [InventarioInsumoController::class,'index'])->name('Inventario.index');
Route::get('/CrearInsumos', [InventarioInsumoController::class,'crearInsumo'])->name('Inventario.crearInsumo');
Route::post('/CrearInsumos', [InventarioInsumoController::class, 'store'])->name('Inventario.store');
Route::get('/Insumo/id={id}', [InventarioInsumoController::class, 'vistaInsumo'])->name('Inventario.vistaInsumo');
Route::get('/ActualizarInsumo/id={id}', [InventarioInsumoController::class, 'show'])->name('Inventario.show');
Route::put('/ActualizarInsumo/id={id}', [InventarioInsumoController::class, 'update'])->name('insumos.update');
Route::delete('/insumosDelete/id={id}',  [InventarioInsumoController::class, 'destroy'])->name('insumos.delete');

//INVENTARIO EQUIPO MEDICO
Route::get('/EquipoMedico/id={id}', [InventarioEquipoMedicoController::class, 'vistaEquipo'])->name('Inventario.vistaequipo');
Route::get('/ActualizarEquipoMedico/id={id}', [InventarioEquipoMedicoController::class, 'show'])->name('Inventario.showEquipo');
Route::put('/ActualizarEquipoMedico/id={id}', [InventarioEquipoMedicoController::class, 'update'])->name('Inventario.updateEquipo');
Route::get('/CrearEquipoMedico', [InventarioEquipoMedicoController::class,'crearEquipoMedico'])->name('Inventario.crearEquipo');
Route::post('/CrearEquipoMedico', [InventarioEquipoMedicoController::class, 'store'])->name('Inventario.crear');
Route::delete('/equipoMedicoDelete/id={id}',  [InventarioEquipoMedicoController::class, 'destroy'])->name('equipo.delete');

//PROVEEDORES
Route::get('/Proveedores', [ProveedorController::class,'index'])->name('tablaProvedor');
Route::get('/Proveedor/id={id}', [ProveedorController::class, 'vistaProveedor'])->name('vistaProveedor');




Route::view('/profile','profile')->name('profile');

// Ruta para mostrar el formulario de asignación de roles
Route::get('/asignar-roles', [AsignarRolController::class, 'index'])->name('asignar-roles.index');

// Ruta para procesar el formulario de asignación de roles
Route::post('/asignar-roles', [AsignarRolController::class, 'assign'])->name('asignar-roles.assign');

// Rutas para crear usuarios y asignar roles
Route::get('/user/create', [CuentasController::class, 'create'])->name('user.create');
Route::post('/user/store', [CuentasController::class, 'store'])->name('user.store');
