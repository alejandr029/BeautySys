<?php

use Illuminate\Support\Facades\Route;

use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;
// use App\Http\Controllers\AsignarRolController;
use App\Http\Controllers\CuentasController;
use App\Http\Controllers\InventarioInsumoController;
use App\Http\Controllers\InventarioEquipoMedicoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\RestauracionController;
use App\Http\Controllers\CirugiaController;
use App\Http\Controllers\ConsultasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AlergiasController;
use App\Http\Controllers\EnfermedadesCronicasController;

Route::view('/','layout.landing');

Route::get('/IniciarSesion', [AuthenticatedSessionController::class, 'create'])->middleware('guest')->name('login');
Route::post('/IniciarSesion', [AuthenticatedSessionController::class, 'store'])->middleware('web', 'guest');

Route::get('/Registro', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/Registro', [RegisteredUserController::class, 'store'])->middleware('guest');

// todo: agregar autentificacion para rol user
Route::middleware(['auth'])->group(function () {
//    Route::middleware(['role:user'])->group(function () {

        // //Route::view('/dashboard', 'layout.template')->name('dashboard');
        // Route::get('/dashboard', function () {
        //     session(['activeTab' => 'Dashboard']);
        //     return view('dashboard');
        // })->name('dashboard');
        // // Route::view('/tables','tables')->name('tables');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        // Route::get('/dashboard/id={id}', [DashboardController::class, 'index_user'])->name('dashboard_user');

        Route::get('/profile', function () {
            session(['activeTab' => 'Profile']);
            return view('profile');
        })->name('profile');

        Route::get('/Alergias/{id}', [AlergiasController::class, 'index'])->name('alergiasTabla');
        Route::post('/Alergias/{id}', [AlergiasController::class, 'añadirAlergia'])->name('añadirAlergia');

        Route::get('/EnfermedadesCronicas/{id}', [EnfermedadesCronicasController::class, 'index'])->name('enfermedadesCronicasTabla');
        Route::post('/EnfermedadesCronicas/{id}', [EnfermedadesCronicasController::class, 'añadirEnfermedadCronica'])->name('añadirEnfermedadCronica');

        // Route::view('/Alergias','Alergia.alergiaTable')->name('Alergias');
//    });

    // todo: agregar autentificacion para rol staff y admin
//    Route::middleware(['role:admin|staff'])->group(function () {

        // CUENTAS

        // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/cuentas', [CuentasController::class, 'index'])->name('Cuentas.index');
        Route::get('/crear-cuenta', [CuentasController::class, 'create'])->name('Cuentas.crear');
        Route::post('/crear-cuenta', [CuentasController::class, 'store'])->name('user.store');
        Route::get('/cuentas-editar/id={id}', [CuentasController::class, 'edit'])->name('Cuentas.edit');
        Route::put('/cuentas-actualizar/id={id}', [CuentasController::class, 'update'])->name('Cuentas.update');
        Route::get('/cuentas-eliminar/{id}', [CuentasController::class, 'destroyForm'])->name('Cuentas.eliminar');
        Route::post('/cuentas/{id}', [CuentasController::class, 'destroy'])->name('Cuentas.destroy');
        Route::get('/cuentas-vista/id={id}', [CuentasController::class, 'show'])->name('Cuentas.visualizar');

        // INVENTARIO INSUMOS
        Route::get('/inventario', [InventarioInsumoController::class, 'index'])->name('Inventario.index');
        Route::get('/crear-insumos', [InventarioInsumoController::class, 'crearInsumo'])->name('Inventario.crearInsumo');
        Route::post('/crear-insumos', [InventarioInsumoController::class, 'store'])->name('Inventario.store');
        Route::get('/insumo/id={id}', [InventarioInsumoController::class, 'vistaInsumo'])->name('Inventario.vistaInsumo');
        Route::get('/actualizar-insumo/id={id}', [InventarioInsumoController::class, 'show'])->name('Inventario.show');
        Route::put('/actualizar-insumo/id={id}', [InventarioInsumoController::class, 'update'])->name('insumos.update');
        Route::get('/cambiar-estado-insumo/id={id}', [InventarioInsumoController::class, 'cambiarEstado'])->name('insumos.cambiarEstado');
        Route::post('/habilitar-insumo/id={id}', [InventarioInsumoController::class, 'habilitarInsumo'])->name('insumos.habilitar');
        Route::post('/deshabilitar-insumo/id={id}', [InventarioInsumoController::class, 'deshabilitarInsumo'])->name('insumos.deshabilitar');

        // INVENTARIO EQUIPO MEDICO
        Route::get('/equipo-medico/id={id}', [InventarioEquipoMedicoController::class, 'vistaEquipo'])->name('Inventario.vistaequipo');
        Route::get('/actualizar-equipo-medico/id={id}', [InventarioEquipoMedicoController::class, 'show'])->name('Inventario.showEquipo');
        Route::put('/actualizar-equipo-medico/id={id}', [InventarioEquipoMedicoController::class, 'update'])->name('Inventario.updateEquipo');
        Route::get('/crear-equipo-medico', [InventarioEquipoMedicoController::class, 'crearEquipoMedico'])->name('Inventario.crearEquipo');
        Route::post('/crear-equipo-medico', [InventarioEquipoMedicoController::class, 'store'])->name('Inventario.crear');
        Route::get('/cambiar-estado-equipo/id={id}', [InventarioEquipoMedicoController::class, 'cambiarEstado'])->name('equipo.cambiarEstado');
        Route::post('/habilitar-equipo/id={id}', [InventarioEquipoMedicoController::class, 'habilitarEquipo'])->name('equipo.habilitar');
        Route::post('/deshabilitar-equipo/id={id}', [InventarioEquipoMedicoController::class, 'deshabilitarEquipo'])->name('equipo.deshabilitar');

        // PROVEEDORES
        Route::get('/proveedores', [ProveedorController::class, 'index'])->name('tablaProvedor');
        Route::get('/proveedor/id={id}', [ProveedorController::class, 'vistaProveedor'])->name('vistaProveedor');
        Route::get('/actualizar-proveedor/id={id}', [ProveedorController::class, 'show'])->name('vistActualizarProveedor');
        Route::put('/actualizar-proveedor/id={id}', [ProveedorController::class, 'update'])->name('actualizarProveedor');
        Route::view('/crear-proveedor', 'Proveedor.proveedorCrear')->name('vistaCrearProveedor');
        Route::post('/crear-proveedor', [ProveedorController::class, 'store'])->name('crearProveedor');
        Route::get('/cambiar-estado-proveedor/{id}', [ProveedorController::class, 'cambiarEstado'])->name('cambiarEstadoProveedor');
        Route::post('/habilitar-proveedor/id={id}', [ProveedorController::class, 'habilitarProveedor'])->name('habilitarProveedor');
        Route::post('/deshabilitar-proveedor/id={id}', [ProveedorController::class, 'deshabilitarProveedor'])->name('deshabilitarProveedor');

        // BASE DE DATOS
        Route::get('/restauracion', [RestauracionController::class, 'index'])->name('restauracion.index');
        Route::get('/restaurar/guardar', [RestauracionController::class, 'backup_diferencial'])->name('restaurar.guardar');
        Route::get('/restaurar/todo', [RestauracionController::class, 'Restorage_principal'])->name('restaurar.todo');
        Route::get('/restaurar/file={file}', [RestauracionController::class, 'Restorage_differencial'])->name('restaurar_file');

        // CITAS
        Route::get('/citas', [CitasController::class, 'index'])->name('Citas.index');
        Route::get('/ver-cita/id={id}', [CitasController::class, 'show'])->name('Citas.visualizar');
        Route::get('/crear-cita', [CitasController::class, 'create'])->name('Citas.crear');
        Route::post('/crear-cita', [CitasController::class, 'store'])->name('Citas.store');
        Route::get('/actualizar-cita/id={id}', [CitasController::class, 'edit'])->name('Citas.editar');
        Route::put('/actualizar-cita/id={id}', [CitasController::class, 'update'])->name('Citas.update');
        Route::delete('/eliminar-cita/id={id}', [CitasController::class, 'destroyForm'])->name('Citas.destroyForm');
        Route::delete('/eliminar/id={id}', [CitasController::class, 'destroy'])->name('Citas.destroy');

        // CIRUGIA
        Route::get('/cirugia', [CirugiaController::class, 'index'])->name('tablaCirugia');
        Route::get('/cirugia-crear', [CirugiaController::class, 'selectConsultas'])->name('vistacrearCirugia');
        Route::get('/cirugia-datos-paciente/{id}', [CirugiaController::class, 'pacienteCirugia'])->name('datosPaciente');
        Route::get('/cirugia-datos-cirugia/{id}', [CirugiaController::class, 'datosCirugia'])->name('datosCirugia');
        Route::get('/cirugia-obtener-alergias-enfermedades/{id}', [CirugiaController::class, 'datosAlergiaEnfermedades'])->name('datosAlergiaEnfermedades');
        Route::post('/cirugia-crear', [CirugiaController::class, 'store'])->name('crearCirugia');
        Route::get('/cirugia-actualizar/id={id}', [CirugiaController::class, 'show'])->name('vistaActualizarCirugia');
        Route::post('/cirugia-anadir-insumo-equipo', [CirugiaController::class, 'añadirInsumoEquipo'])->name('añadirInsumoEquipo');
        Route::put('/cirugia-actualizar/id={id}', [CirugiaController::class, 'update'])->name('ActualizarCirugia');
        Route::get('/cirugia-vista/id={id}', [CirugiaController::class, 'vistaCirugia'])->name('vistaCirugia');
        Route::get('/cirugia-cancelar-form/id={id}', [CirugiaController::class, 'cancelarForm'])->name('CancelarCirugiaForm');
        Route::put('/cirugia-cancelar/id={id}', [CirugiaController::class, 'cancelar'])->name('CancelarCirugia');
        Route::get('/obtenerAnalisis/{id}', [CirugiaController::class, 'obtenerAnalisis'])->name('obtener.analisis');
        Route::get('/ver_pdf/{id_analisis}', [CirugiaController::class, 'mostrarPDF'])->name('mostrar.pdf');

        // CONSULTAS
        Route::get('/consultas', [ConsultasController::class, 'index'])->name('consultas.index');
        Route::get('/consultas/crear', [ConsultasController::class, 'crear_vista'])->name('crearConsulta');
        Route::post('/consultas/crear', [ConsultasController::class, 'crear'])->name('crearConsulta.crear');
        Route::get('/consultascrear/id={id}', [ConsultasController::class, 'show'])->name('consultavista');
        Route::get('/consultasactualizar/id={id}', [ConsultasController::class, 'showActualizar'])->name('ConsultaActualizarVista');
        Route::put('/consultasactualizar/{id}', [ConsultasController::class, 'actualizarConsulta'])->name('ConsultaActualizar');
        Route::get('/consultaPacientes/{busqueda}', [ConsultasController::class, 'pacientesConsulta'])->name('datosPacientes_consulta');
        Route::get('/consultaPaciente/{id}', [ConsultasController::class, 'pacienteConsulta'])->name('datosPaciente_consulta');
        Route::put('/Consultaanalisis/{id}', [ConsultasController::class, 'actualizarAnalisis'])->name('analisis_paciente_actualizar');
        Route::post('/analisiscrear/id={id}', [ConsultasController::class, 'crear_analisis'])->name('analisis_paciente');
        Route::get('/ConsultaCancelarForm/{id}', [ConsultasController::class, 'cancelarForm'])->name('CancelarConsultaForm');
        Route::put('/ConsultaCancelar/{id}', [ConsultasController::class, 'cancelar'])->name('CancelarConsulta');
        Route::get('/ver_pdf/{id_analisis}', [ConsultasController::class, 'mostrarPDF'])->name('mostrar.pdf');
        Route::get('/eliminar/{id_analisis}', [ConsultasController::class, 'eliminarPDF'])->name('eliminar.pdf');
//    });
});

// Ruta para mostrar el formulario de asignación de roles
// // Route::get('/asignar-roles', [AsignarRolController::class, 'index'])->name('asignar-roles.index');
// Ruta para procesar el formulario de asignación de roles
// // Route::post('/asignar-roles', [AsignarRolController::class, 'assign'])->name('asignar-roles.assign');
// Rutas para crear usuarios y asignar roles
// Route::get('/user/create', [CuentasController::class, 'create'])->name('user.create');
// Route::post('/user/store', [CuentasController::class, 'store'])->name('user.store');
