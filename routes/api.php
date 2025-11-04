<?php

use App\Http\Controllers\Api\StatsController;


Route::get('/stats/sales', [StatsController::class, 'salesByDay']);
Route::get('/stats/visits', [StatsController::class, 'visitsBySection']);