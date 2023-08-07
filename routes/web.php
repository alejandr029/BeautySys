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
use App\Http\Controllers\CitasController;
use App\Http\Controllers\RestauracionController;
use App\Http\Controllers\CirugiaController;
use App\Http\Controllers\ConsultasController;





Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/', [AuthenticatedSessionController::class, 'store'])->middleware('guest');

Route::get('/registro', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/registro', [RegisteredUserController::class, 'store'])->middleware('guest');

//Route::view('/dashboard', 'layout.template')->name('dashboard');
Route::get('/dashboard', function () {
    session(['activeTab' => 'Dashboard']);
    return view('dashboard');
})->name('dashboard');
// Route::view('/tables','tables')->name('tables');

// CUENTAS
Route::get('/cuentas', [CuentasController::class, 'index'])->name('Cuentas.index');
Route::get('/crear/cuenta', [CuentasController::class, 'create'])->name('Cuentas.crear');
Route::post('/crear/cuenta', [CuentasController::class, 'store'])->name('user.store');
Route::get('/cuentasEditar/id={id}', [CuentasController::class, 'edit'])->name('Cuentas.edit');
Route::put('/cuentasActualizar/id={id}', [CuentasController::class, 'update'])->name('Cuentas.update');
Route::get('/cuentasEliminar/{id}', [CuentasController::class, 'destroyForm'])->name('Cuentas.eliminar');
Route::post('/cuentas/{id}', [CuentasController::class, 'destroy'])->name('Cuentas.destroy');
Route::get('/cuentasVista/id={id}', [CuentasController::class, 'show'])->name('Cuentas.visualizar');

//INVENTARIO INSUMOS
Route::get('/Inventario', [InventarioInsumoController::class, 'index'])->name('Inventario.index');
Route::get('/CrearInsumos', [InventarioInsumoController::class, 'crearInsumo'])->name('Inventario.crearInsumo');
Route::post('/CrearInsumos', [InventarioInsumoController::class, 'store'])->name('Inventario.store');
Route::get('/Insumo/id={id}', [InventarioInsumoController::class, 'vistaInsumo'])->name('Inventario.vistaInsumo');
Route::get('/ActualizarInsumo/id={id}', [InventarioInsumoController::class, 'show'])->name('Inventario.show');
Route::put('/ActualizarInsumo/id={id}', [InventarioInsumoController::class, 'update'])->name('insumos.update');
Route::delete('/insumosDelete/id={id}', [InventarioInsumoController::class, 'destroy'])->name('insumos.delete');

//INVENTARIO EQUIPO MEDICO
Route::get('/EquipoMedico/id={id}', [InventarioEquipoMedicoController::class, 'vistaEquipo'])->name('Inventario.vistaequipo');
Route::get('/ActualizarEquipoMedico/id={id}', [InventarioEquipoMedicoController::class, 'show'])->name('Inventario.showEquipo');
Route::put('/ActualizarEquipoMedico/id={id}', [InventarioEquipoMedicoController::class, 'update'])->name('Inventario.updateEquipo');
Route::get('/CrearEquipoMedico', [InventarioEquipoMedicoController::class, 'crearEquipoMedico'])->name('Inventario.crearEquipo');
Route::post('/CrearEquipoMedico', [InventarioEquipoMedicoController::class, 'store'])->name('Inventario.crear');
Route::delete('/equipoMedicoDelete/id={id}', [InventarioEquipoMedicoController::class, 'destroy'])->name('equipo.delete');

//PROVEEDORES
Route::get('/Proveedores', [ProveedorController::class, 'index'])->name('tablaProvedor');
Route::get('/Proveedor/id={id}', [ProveedorController::class, 'vistaProveedor'])->name('vistaProveedor');
Route::get('/ActualizarProveedor/id={id}', [ProveedorController::class, 'show'])->name('vistActualizarProveedor');
Route::put('/ActualizarProveedor/id={id}', [ProveedorController::class, 'update'])->name('actualizarProveedor');
Route::view('/crearProveedor', 'Proveedor.proveedorCrear')->name('vistaCrearProveedor');
Route::post('/crearProveedor', [ProveedorController::class, 'store'])->name('crearProveedor');
Route::delete('/eliminarProveedor/id={id}', [ProveedorController::class, 'destroy'])->name('eliminarProveedor');

//BASE DE DATOS
Route::get('/restauracion', [RestauracionController::class,'index'])->name('restauracion.index');
Route::get('/restaurar/guardar', [RestauracionController::class,'backup_diferencial'])->name('restaurar.guardar');
Route::get('/restaurar/todo', [RestauracionController::class,'Restorage_principal'])->name('restaurar.todo');
Route::get('/restaurar/file={file}', [RestauracionController::class,'Restorage_differencial'])->name('restaurar_file');

Route::get('/citas', [CitasController::class, 'index'])->name('Citas.index');
Route::get('/ver-cita/id={id}', [CitasController::class, 'show'])->name('Citas.visualizar');
Route::get('/crear-cita', [CitasController::class, 'create'])->name('Citas.crear');
Route::post('/crear-cita', [CitasController::class, 'store'])->name('Citas.store');
Route::get('/actualizar-cita/id={id}', [CitasController::class, 'edit'])->name('Citas.editar');
Route::put('/actualizar-cita/id={id}', [CitasController::class, 'update'])->name('Citas.actualizar');
Route::delete('/eliminar-cita/id={id}', [CitasController::class, 'destroyForm'])->name('Citas.destroyForm');
Route::delete('/eliminar/id={id}', [CitasController::class, 'destroy'])->name('Citas.destroy');

//CONSULTAS
Route::get('/Cirugia', [CirugiaController::class, 'index'])->name('tablaCirugia');
Route::get('/CirugiaCrear', [CirugiaController::class, 'selectConsultas'])->name('crearCirugia');
Route::get('/CirugiadatosPaciente/{id}', [CirugiaController::class, 'pacienteCirugia'])->name('datosPaciente');
Route::get('/Cirugiadatoscirugia/{id}', [CirugiaController::class, 'datosCirugia'])->name('datosCirugia');

//SECCION DE CONSULTAS
Route::get('/consultas', [ConsultasController::class, 'index'])->name('consultas.index');
Route::get('/consultas/crear', [ConsultasController::class, 'crear'])->name('crearConsulta');

Route::get('/profile', function () {
    session(['activeTab' => 'Profile']);
    return view('profile');
})->name('profile');



// Ruta para mostrar el formulario de asignación de roles
// // Route::get('/asignar-roles', [AsignarRolController::class, 'index'])->name('asignar-roles.index');
// Ruta para procesar el formulario de asignación de roles
// // Route::post('/asignar-roles', [AsignarRolController::class, 'assign'])->name('asignar-roles.assign');
// Rutas para crear usuarios y asignar roles
// Route::get('/user/create', [CuentasController::class, 'create'])->name('user.create');
// Route::post('/user/store', [CuentasController::class, 'store'])->name('user.store');
