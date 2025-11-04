<?php

namespace App\Http\Controllers;

use App\Models\Candy;
use Illuminate\Http\Request;

class CandyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Candy::latest()->paginate(10);
        return view('admin.candies.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.candies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $r->validate(['name' => 'required', 'price' => 'required|numeric']);
        Candy::create($r->only('name', 'price', 'image'));
        return redirect()->route('admin.candies.index')->with('success', 'Producto creado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candy $candy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candy $candy)
    {
        return view('admin.candies.edit', compact('candy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Candy $candy)
    {
        $r->validate(['name' => 'required', 'price' => 'required|numeric']);
        $candy->update($r->only('name', 'price', 'image'));
        return redirect()->route('admin.candies.index')->with('success', 'Producto actualizado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candy $candy)
    {
        $candy->delete();
        return back()->with('success', 'Producto eliminado');
    }
}

