<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pedido;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Traemos los pedidos del usuario autenticado
        $pedidos = Pedido::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact('user', 'pedidos'));
    }
}
