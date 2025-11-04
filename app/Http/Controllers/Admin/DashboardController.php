<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\SnackOrder;
use App\Models\Visit;
use App\Models\Movie;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $kpiRevenue = Ticket::whereDate('created_at','>=', now()->subDays(30))->sum('price_total')
                    + SnackOrder::whereDate('created_at','>=', now()->subDays(30))->sum('total');

        $kpiTickets = Ticket::whereDate('created_at','>=', now()->subDays(30))->sum('qty');
        $kpiVisits  = Visit::whereDate('visited_at','>=', now()->subDays(30))->count();
        $kpiMovies  = Movie::count();

        return view('admin.dashboard', compact('kpiRevenue','kpiTickets','kpiVisits','kpiMovies'));
    }
}
