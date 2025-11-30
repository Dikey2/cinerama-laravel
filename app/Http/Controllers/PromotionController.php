<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * ⭐ PÁGINA PÚBLICA – Mostrar todas las promociones al usuario normal
     */
    public function publicIndex()
    {
        $promociones = Promotion::all();
        return view('promociones.index', compact('promociones'));
    }

    /**
     * ⭐ ADMIN – Listado de promociones
     */
    public function index()
    {
        $items = Promotion::latest()->paginate(10);
        return view('admin.promociones.index', compact('items'));
    }

    /**
     * ⭐ ADMIN – Formulario para crear nueva promoción
     */
    public function create()
    {
        return view('admin.promociones.create');
    }

    /**
     * ⭐ ADMIN – Guardar promoción nueva
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'      => 'required|string',
            'descripcion' => 'nullable|string',
            'estado'      => 'required|string',
        ]);

        Promotion::create($data);

        return redirect()
            ->route('admin.promociones.index')
            ->with('success', 'Promoción creada correctamente');
    }

    /**
     * ⭐ ADMIN – Editar promoción
     */
    public function edit(Promotion $promocione)
    {
        return view('admin.promociones.edit', compact('promocione'));
    }

    /**
     * ⭐ ADMIN – Actualizar promoción existente
     */
    public function update(Request $request, Promotion $promocione)
    {
        $data = $request->validate([
            'titulo'      => 'required|string',
            'descripcion' => 'nullable|string',
            'estado'      => 'required|string',
        ]);

        $promocione->update($data);

        return redirect()
            ->route('admin.promociones.index')
            ->with('success', 'Promoción actualizada');
    }

    /**
     * ⭐ ADMIN – Eliminar promoción
     */
    public function destroy(Promotion $promocione)
    {
        $promocione->delete();

        return redirect()
            ->route('admin.promociones.index')
            ->with('success', 'Promoción eliminada correctamente');
    }
}


