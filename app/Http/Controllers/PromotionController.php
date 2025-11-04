<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Promotion::latest()->paginate(10);
        return view('admin.promotions.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.promotions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $r->validate(['title' => 'required']);
        Promotion::create($r->only('title', 'image', 'discount_text', 'valid_until'));
        return redirect()->route('admin.promotions.index')->with('success', 'Promoción creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return view('admin.promotions.edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Promotion $promotion)
    {
        $r->validate(['title' => 'required']);
        $promotion->update($r->only('title', 'image', 'discount_text', 'valid_until'));
        return redirect()->route('admin.promotions.index')->with('success', 'Promoción actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return back()->with('success', 'Promoción eliminada');
    }
}

