<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Cinema;
use App\Models\Promotion;
use App\Models\Pedido;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stats' => [
                'movies'      => Movie::count(),
                'cinemas'     => Cinema::count(),
                'promos'      => Promotion::count(),
                'orders'      => Pedido::count(),
                'users'       => User::count(),
            ],
            // si aún no tienes pedidos, puedes dejar esto vacío o comentar
            'lastOrders' => Pedido::latest()->take(5)->get(),
        ]);
    }
}

