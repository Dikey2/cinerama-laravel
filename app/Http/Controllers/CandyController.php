<?php

namespace App\Http\Controllers;

use App\Models\Candy;
use Illuminate\Http\Request;

class CandyController extends Controller
{
    /**
     * PUBLIC — Vista del cliente
     */
    public function public()
    {
        // Como tu tabla no tiene "categoria", quitamos los filtros
        $items = Candy::all();

        return view('dulceria.index', compact('items'));
    }

    /**
     * ADMIN — Index
     */
    public function index()
    {
        $items = Candy::latest()->paginate(15);
        return view('admin.candies.index', compact('items'));
    }

    /**
     * ADMIN — Crear
     */
    public function create()
    {
        return view('admin.candies.create');
    }

    /**
     * ADMIN — Guardar
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048'
        ]);

        // Convertir a campos reales de tu base de datos
        $candyData = [
            'name' => $data['nombre'],
            'price' => $data['precio'],
        ];

        if ($request->hasFile('imagen')) {
            $candyData['image'] = $request->file('imagen')->store('candies', 'public');
        }

        Candy::create($candyData);

        return redirect()->route('admin.candies.index')
            ->with('success', 'Producto creado correctamente');
    }

    /**
     * ADMIN — Editar
     */
    public function edit(Candy $candy)
    {
        return view('admin.candies.edit', compact('candy'));
    }

    /**
     * ADMIN — Actualizar
     */
    public function update(Request $request, Candy $candy)
    {
        $data = $request->validate([
            'nombre' => 'required|string',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|image|max:2048'
        ]);

        $candyData = [
            'name'  => $data['nombre'],
            'price' => $data['precio'],
        ];

        if ($request->hasFile('imagen')) {
            $candyData['image'] = $request->file('imagen')->store('candies', 'public');
        }

        $candy->update($candyData);

        return redirect()->route('admin.candies.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * ADMIN — Eliminar
     */
    public function destroy(Candy $candy)
    {
        $candy->delete();

        return redirect()->route('admin.candies.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}




