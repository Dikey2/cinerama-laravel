<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatsController extends Controller
{
public function salesByDay()
{
$data = DB::table('sales')
->select(DB::raw('sale_date as date, SUM(total_amount) as total'))
->groupBy('date')->orderBy('date')->get();
return response()->json($data);
}


public function visitsBySection()
{
$data = DB::table('visits')
->select('section', DB::raw('SUM(views) as total'))
->groupBy('section')->get();
return response()->json($data);
}
}
