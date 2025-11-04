<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use Illuminate\Http\Request;

class CinemaController extends Controller
{
    /**
     * Página pública: lista de cines (vista tipo Cineplanet con filtros)
     */
    public function index(Request $request)
    {
        // Lista fija de cines (simulación de datos)
        $cines = [
            [
                'nombre' => 'Mall Aventura',
                'ciudad' => 'Arequipa',
                'direccion' => 'Av. Porongoche N° 500',
                'formatos' => ['2D', 'REGULAR', '3D'],
                'imagen' => 'https://peruretail.sfo3.cdn.digitaloceanspaces.com/wp-content/uploads/Mall-Aventura-Arequipa-1.jpg'
            ],
            [
                'nombre' => 'Arequipa Mall Plaza',
                'ciudad' => 'Arequipa',
                'direccion' => 'Av. Ejército 793 Cayma',
                'formatos' => ['2D', '3D', 'REGULAR'],
                'imagen' => 'https://www.businessempresarial.com.pe/wp-content/uploads/2022/01/version-2018-109.jpg'
            ],
            [
                'nombre' => 'Arequipa Paseo Central',
                'ciudad' => 'Arequipa',
                'direccion' => 'Av. Arturo Ibañez S/N',
                'formatos' => ['2D', 'REGULAR'],
                'imagen' => 'https://peruretail.sfo3.cdn.digitaloceanspaces.com/wp-content/uploads/Paseo-Central1.jpg'
            ],
            [
                'nombre' => 'Mall del Sur',
                'ciudad' => 'Lima',
                'direccion' => 'San Juan de Miraflores 15801',
                'formatos' => ['3D', 'REGULAR'],
                'imagen' => 'https://sika.scene7.com/is/image/sika/pe-edificacion-y-vivienda-2016-mall-del-sur-01?wid=1920&hei=998&fit=crop%2C1'
            ],
        ];

        // Filtro por ciudad
        if ($request->filled('ciudad') && $request->ciudad !== 'Todas') {
            $cines = array_filter($cines, function ($cine) use ($request) {
                return strtolower($cine['ciudad']) === strtolower($request->ciudad);
            });
        }

        // Filtro por formato
        if ($request->filled('formato') && $request->formato !== 'Todos') {
            $cines = array_filter($cines, function ($cine) use ($request) {
                return in_array($request->formato, $cine['formatos']);
            });
        }

        // Enviar resultados a la vista
        return view('cines', [
            'cines' => $cines,
            'ciudadSeleccionada' => $request->ciudad ?? 'Todas',
            'formatoSeleccionado' => $request->formato ?? 'Todos',
        ]);
    }

    /**
     * Mostrar detalles de un cine específico
     */
    public function show($nombre)
    {
        // Mismo arreglo de cines
        $cines = [
            [
                'nombre' => 'Mall Aventura',
                'ciudad' => 'Arequipa',
                'direccion' => 'Av. Porongoche N° 500',
                'salas' => 6,
                'formatos' => ['2D', '3D', 'REGULAR'],
                'servicios' => ['Estacionamiento', 'Accesibilidad', 'Comida y bebidas'],
                'imagen' => 'https://peruretail.sfo3.cdn.digitaloceanspaces.com/wp-content/uploads/Mall-Aventura-Arequipa-1.jpg'
            ],
            [
                'nombre' => 'Arequipa Mall Plaza',
                'ciudad' => 'Arequipa',
                'direccion' => 'Av. Ejército 793 Cayma',
                'salas' => 8,
                'formatos' => ['2D', '3D', 'REGULAR'],
                'servicios' => ['Estacionamiento', 'Accesibilidad'],
                'imagen' => 'https://www.businessempresarial.com.pe/wp-content/uploads/2022/01/version-2018-109.jpg'
            ],
            [
                'nombre' => 'Arequipa Paseo Central',
                'ciudad' => 'Arequipa',
                'direccion' => 'Av. Arturo Ibañez S/N',
                'salas' => 5,
                'formatos' => ['2D', 'REGULAR'],
                'servicios' => ['Estacionamiento', 'Accesibilidad'],
                'imagen' => 'https://peruretail.sfo3.cdn.digitaloceanspaces.com/wp-content/uploads/Paseo-Central1.jpg'
            ],
            [
                'nombre' => 'Mall del Sur',
                'ciudad' => 'Lima',
                'direccion' => 'San Juan de Miraflores 15801',
                'salas' => 9,
                'formatos' => ['3D', 'REGULAR'],
                'servicios' => ['Estacionamiento', 'Accesibilidad'],
                'imagen' => 'https://sika.scene7.com/is/image/sika/pe-edificacion-y-vivienda-2016-mall-del-sur-01?wid=1920&hei=998&fit=crop%2C1'
            ],
        ];

        // Buscar cine por nombre
        $cine = collect($cines)->firstWhere('nombre', str_replace('-', ' ', urldecode($nombre)));

        if (!$cine) {
            abort(404);
        }

        return view('cine-detalle', compact('cine'));
    }

    /**
     * Panel Admin: lista de cines guardados en BD
     */
    public function adminIndex()
    {
        $items = Cinema::latest()->paginate(10);
        return view('admin.cinemas.index', compact('items'));
    }

    /**
     * Crear nuevo cine (panel admin)
     */
    public function create()
    {
        return view('admin.cinemas.create');
    }

    /**
     * Guardar cine en BD
     */
    public function store(Request $r)
    {
        $r->validate(['name' => 'required']);
        Cinema::create($r->only('name', 'address', 'city'));
        return redirect()->route('admin.cinemas.index')->with('success', 'Cinema creado');
    }

    /**
     * Editar cine (panel admin)
     */
    public function edit(Cinema $cinema)
    {
        return view('admin.cinemas.edit', compact('cinema'));
    }

    /**
     * Actualizar cine en BD
     */
    public function update(Request $r, Cinema $cinema)
    {
        $r->validate(['name' => 'required']);
        $cinema->update($r->only('name', 'address', 'city'));
        return redirect()->route('admin.cinemas.index')->with('success', 'Cinema actualizado');
    }

    /**
     * Eliminar cine
     */
    public function destroy(Cinema $cinema)
    {
        $cinema->delete();
        return back()->with('success', 'Cinema eliminado');
    }
}




