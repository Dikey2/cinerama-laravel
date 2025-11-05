<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\{
    MovieController,
    CinemaController,
    PromotionController,
    CandyController
};

use App\Http\Controllers\ReservaController;

// 🏠 Página principal redirige a Próximos Estrenos
Route::redirect('/', '/proximos-estrenos');

// 🎞️ Próximos Estrenos (Home principal)
Route::get('/proximos-estrenos', fn() => view('proximos'))->name('proximos');

// 🎬 Página de Películas
Route::get('/peliculas', [MovieController::class, 'index'])->name('peliculas');

// 🎦 Página pública de Cines
Route::get('/cines', [CinemaController::class, 'index'])->name('cines');
Route::get('/cines/{nombre}', [CinemaController::class, 'show'])->name('cines.show');

// 🎟️ Página principal de Promociones
Route::get('/promociones', fn() => view('promociones'))->name('promociones');

// 🍿 Página principal de Dulcería
Route::get('/dulceria', fn() => view('dulceria'))->name('dulceria');

// 💳 Página de productos dentro de la Dulcería (categorías)
Route::get('/dulceria/productos', fn() => view('dulceria-productos'))->name('dulceria.productos');

// 👔 Página corporativa
Route::get('/corporativo', fn() => view('corporativo'))->name('corporativo');


// 🛒 CARRITO DE COMPRAS
Route::get('/carrito', [CartController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [CartController::class, 'add'])->name('carrito.add');
Route::patch('/carrito/actualizar', [CartController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/eliminar', [CartController::class, 'remove'])->name('carrito.remove');
Route::delete('/carrito/vaciar', [CartController::class, 'clear'])->name('carrito.clear');
Route::post('/carrito/checkout', [CartController::class, 'checkout'])->name('carrito.checkout');


// 🧾 PEDIDOS (registro y confirmación)
Route::post('/pedido/confirmar', [PedidoController::class, 'confirmar'])->name('pedido.confirmar');
Route::get('/pedido/exito/{codigo}', [PedidoController::class, 'exito'])->name('pedido.exito');


// 💳 Combos Socio
Route::view('/combos/socio', 'combos.socio')->name('combos.socio');

// 🎬 Combos 1 o 2
Route::view('/combos/uno-dos', 'combos.uno_dos')->name('combos.uno_dos');

// 🍿 Canchitas
Route::view('/combos/canchitas', 'combos.canchitas')->name('combos.canchitas');

// 🍫 Dulces
Route::view('/combos/dulces', 'combos.dulces')->name('combos.dulces');

// 🥤 Complementos
Route::view('/combos/complementos', 'combos.complementos')->name('combos.complementos');

Route::get('/butacas', function () {
    return view('butacas');
})->name('butacas');


Route::get('/entradas', function () {
    return view('entradas');
})->name('entradas');

Route::post('/reservar-butacas', [ReservaController::class, 'reservar'])->name('reservas.reservar');
Route::delete('/liberar-butacas', [ReservaController::class, 'liberar'])->name('reservas.liberar');
Route::post('/confirmar-butacas', [ReservaController::class, 'confirmar'])->name('reservas.confirmar');



// 🔸 Páginas individuales de Promociones
Route::view('/promociones/entel', 'promociones.entel')->name('promo.entel');
Route::view('/promociones/pareja', 'promociones.pareja')->name('promo.pareja');
Route::view('/promociones/estudiante', 'promociones.estudiante')->name('promo.estudiante');
Route::view('/promociones/cumple', 'promociones.cumple')->name('promo.cumple');
Route::view('/promociones/vip', 'promociones.vip')->name('promo.vip');
Route::view('/promociones/familia', 'promociones.familia')->name('promo.familia');
Route::view('/promociones/socio', 'promociones.socio')->name('promo.socio');


// 🎛️ Panel de Administración
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::resource('movies', MovieController::class)->except(['show']);
        Route::resource('cinemas', CinemaController::class)->except(['show']);
        Route::resource('promotions', PromotionController::class)->except(['show']);
        Route::resource('candies', CandyController::class)->except(['show']);
    });


// 👤 Rutas protegidas de Perfil
Route::middleware('auth')->group(function () {
    // CRUD de películas
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

    // Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))
        ->middleware(['verified'])
        ->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';






