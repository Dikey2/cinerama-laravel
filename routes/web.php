<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminMovieController;
use App\Models\Pedido;

// 🏠 Página principal
Route::redirect('/', '/proximos-estrenos');

// 🎞️ Próximos Estrenos
Route::get('/proximos-estrenos', [MovieController::class, 'proximos'])->name('proximos');

// 🎬 Películas
Route::get('/peliculas', [MovieController::class, 'index'])->name('peliculas');

// 🎦 Cines
Route::get('/cines', [CinemaController::class, 'index'])->name('cines');
Route::get('/cines/{nombre}', [CinemaController::class, 'show'])->name('cines.show');

// 🎟️ Promociones
Route::get('/promociones', fn() => view('promociones'))->name('promociones');

// 🍿 Dulcería
Route::get('/dulceria', fn() => view('dulceria'))->name('dulceria');
Route::get('/dulceria/productos', fn() => view('dulceria-productos'))->name('dulceria.productos');

// 👔 Corporativo
Route::view('/corporativo', 'corporativo')->name('corporativo');

// 🛒 CARRITO
Route::get('/carrito', [CartController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [CartController::class, 'add'])->name('carrito.add');
Route::patch('/carrito/actualizar', [CartController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/eliminar', [CartController::class, 'remove'])->name('carrito.remove');
Route::delete('/carrito/vaciar', [CartController::class, 'clear'])->name('carrito.clear');
Route::post('/carrito/checkout', [CartController::class, 'checkout'])->name('carrito.checkout');

// 🧾 PEDIDOS
Route::post('/pedido/confirmar', [PedidoController::class, 'confirmar'])->name('pedido.confirmar');
Route::get('/pedido/exito/{codigo}', [PedidoController::class, 'exito'])->name('pedido.exito');
Route::get('/carrito/exito/{codigo}', [CartController::class, 'exito'])->name('carrito.exito');

// 💳 COMBOS
Route::view('/combos/socio', 'combos.socio')->name('combos.socio');
Route::view('/combos/uno-dos', 'combos.uno_dos')->name('combos.uno_dos');
Route::view('/combos/canchitas', 'combos.canchitas')->name('combos.canchitas');
Route::view('/combos/dulces', 'combos.dulces')->name('combos.dulces');
Route::view('/combos/complementos', 'combos.complementos')->name('combos.complementos');

// 🎟️ BUTACAS Y ENTRADAS
Route::get('/butacas', [ReservaController::class, 'index'])->name('butacas');
Route::get('/entradas', fn() => view('entradas'))->name('entradas');

// 🎫 RESERVAS (funcional)
Route::post('/reservar-butacas',  [ReservaController::class, 'reservar'])->name('reservas.reservar');
Route::post('/liberar-butacas',   [ReservaController::class, 'liberar'])->name('reservas.liberar');
Route::post('/confirmar-butacas', [ReservaController::class, 'confirmar'])->name('reservas.confirmar');

// 📩 CONTACTO
Route::post('/contacto/enviar', [ContactController::class, 'send'])->name('contacto.send');

// 🎛️ PANEL ADMINISTRATIVO
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::resource('movies', MovieController::class)->except(['show']);
        Route::resource('cinemas', CinemaController::class)->except(['show']);
        Route::resource('promotions', PromotionController::class)->except(['show']);
        Route::resource('candies', CandyController::class)->except(['show']);
    });

// 🎬 CRUD admin separado
Route::prefix('admin')->group(function () {
    Route::resource('movies', AdminMovieController::class);
});

// 🔸 Promociones individuales
Route::view('/promociones/entel', 'promociones.entel')->name('promo.entel');
Route::view('/promociones/pareja', 'promociones.pareja')->name('promo.pareja');
Route::view('/promociones/estudiante', 'promociones.estudiante')->name('promo.estudiante');
Route::view('/promociones/cumple', 'promociones.cumple')->name('promo.cumple');
Route::view('/promociones/vip', 'promociones.vip')->name('promo.vip');
Route::view('/promociones/familia', 'promociones.familia')->name('promo.familia');
Route::view('/promociones/socio', 'promociones.socio')->name('promo.socio');

// 👤 PERFIL DE USUARIO
Route::middleware('auth')->group(function () {
    // CRUD Películas
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');

    // Dashboard
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $pedidos = Pedido::orderBy('created_at', 'desc')->take(5)->get();
        return view('dashboard', compact('user', 'pedidos'));
    })->middleware(['verified'])->name('dashboard');

    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';





