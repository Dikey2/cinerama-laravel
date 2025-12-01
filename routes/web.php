<?php

use Illuminate\Support\Facades\Route;

// -----------------------------
// Controladores Públicos
// -----------------------------
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\CandyController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\SeatController;  
use App\Http\Controllers\ReservaController;


// -----------------------------
// Controladores Admin
// -----------------------------
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\MovieAdminController;
use App\Http\Controllers\Admin\ShowtimeAdminController;


// ======================================================
// 🏠 PÁGINA PRINCIPAL
// ======================================================
Route::redirect('/', '/proximos-estrenos');


// ======================================================
// ⭐ CORPORATIVO
// ======================================================
Route::view('/corporativo', 'corporativo.index')->name('corporativo');


// ======================================================
// 🎞️ SECCIONES PÚBLICAS
// ======================================================

// Próximos estrenos
Route::get('/proximos-estrenos', [MovieController::class, 'proximos'])
    ->name('proximos-estrenos');

// Películas
Route::get('/peliculas', [MovieController::class, 'index'])
    ->name('peliculas');

// Cines
Route::get('/cines', [CinemaController::class, 'index'])
    ->name('cines');

Route::get('/cines/{nombre}', [CinemaController::class, 'show'])
    ->name('cines.show');

// Dulcería
Route::get('/dulceria', [CandyController::class, 'public'])
    ->name('dulceria');


// ======================================================
// 🎬 FUNCIONES (SHOWTIMES) & ASIENTOS — PÚBLICO
// ======================================================

// Ver funciones de una película
Route::get('/peliculas/{movie}/funciones', [ShowtimeController::class, 'porPelicula'])
    ->name('showtimes.porPelicula');

// Ver butacas
Route::get('/funcion/{showtime}/asientos', [SeatController::class, 'show'])
    ->name('asientos.ver');


// Nueva ruta solicitada: PANTALLA DE ENTRADAS
Route::get('/funcion/{showtime}/entradas', [SeatController::class, 'entradas'])
    ->name('asientos.entradas');


// Reservar butacas
Route::post('/funcion/{showtime}/asientos/reservar', [SeatController::class, 'reserve'])
    ->name('asientos.reservar');

// Confirmar butacas
Route::post('/funcion/{showtime}/asientos/confirmar', [SeatController::class, 'confirm'])
    ->name('asientos.confirmar');

Route::get('/funcion/{showtime}/elegir-modo', [SeatController::class, 'elegirModo'])
    ->name('asientos.elegirModo');



// ======================================================
// 🎉 PROMOCIONES PÚBLICAS
// ======================================================
Route::get('/promociones', [PromotionController::class, 'publicIndex'])
    ->name('promociones');

Route::prefix('promociones')->name('promociones.')->group(function () {
    Route::view('/cumple', 'promociones.cumple')->name('cumple');
    Route::view('/entel', 'promociones.entel')->name('entel');
    Route::view('/estudiante', 'promociones.estudiante')->name('estudiante');
    Route::view('/familia', 'promociones.familia')->name('familia');
    Route::view('/pareja', 'promociones.pareja')->name('pareja');
    Route::view('/socio', 'promociones.socio')->name('socio');
    Route::view('/vip', 'promociones.vip')->name('vip');
});


// ======================================================
// 🧾 PEDIDOS PÚBLICOS
// ======================================================
Route::post('/pedido/confirmar', [PedidoController::class, 'confirmar'])
    ->name('pedido.confirmar');

Route::get('/pedido/exito/{codigo}', [PedidoController::class, 'exito'])
    ->name('pedido.exito');


// ======================================================
// 🛒 CARRITO
// ======================================================
Route::get('/carrito', [CartController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [CartController::class, 'add'])->name('carrito.add');
Route::patch('/carrito/actualizar', [CartController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/eliminar', [CartController::class, 'remove'])->name('carrito.remove');
Route::delete('/carrito/vaciar', [CartController::class, 'clear'])->name('carrito.clear');


// ======================================================
// 📩 CONTACTO
// ======================================================
Route::post('/contacto/enviar', [ContactoController::class, 'send'])
    ->name('contacto.send');

    // ======================================================
// 🎟️ GUARDAR ENTRADAS (PÚBLICO)
// ======================================================
Route::post('/guardar-entradas', [ReservaController::class, 'guardarEntradas'])
    ->name('guardar.entradas'); 

    Route::post('/asiento/bloquear', [ReservaController::class, 'bloquearAsiento']);


         Route::get('/carrito/checkout', function () {
    return view('carrito.checkout');
    })->name('carrito.checkout');

// ======================================================
// 👑 ADMINISTRACIÓN
// ======================================================
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Usuarios
        Route::resource('users', UserAdminController::class)->except(['show']);

        // Películas
        Route::resource('movies', MovieAdminController::class);

        // Cines
        Route::resource('cinemas', CinemaController::class)->except(['show']);

        // Promociones
        Route::resource('promociones', PromotionController::class)->except(['show']);

        // Dulcería
        Route::resource('candies', CandyController::class)->except(['show']);

        // Funciones
        Route::resource('showtimes', ShowtimeAdminController::class)->except(['show']);

        // Asientos
        Route::get('showtimes/{showtime}/asientos', [SeatController::class, 'adminIndex'])
            ->name('showtimes.asientos');

        // Configuración
        Route::view('/config', 'admin.config.index')->name('config');
 
    });


// ===========================
// BENEFICIOS / LOGIN INTERMEDIO
// ===========================
Route::get('/beneficios/login', [SeatController::class, 'beneficiosLogin'])
    ->name('beneficios.login');

Route::post('/beneficios/procesar', [SeatController::class, 'beneficiosProcesar'])
    ->name('beneficios.procesar');


// ======================================================
// 👤 PERFIL DE USUARIO
// ======================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    


});


// ======================================================
// 🔐 AUTENTICACIÓN
// ======================================================
require __DIR__ . '/auth.php';









