@extends('admin.layout')

@section('title', 'Configuración')
@section('header_title', 'Configuración del sistema')
@section('header_subtitle', 'Ajusta la información general y preferencias')

@section('content')

<div class="bg-white shadow-md rounded-xl p-6">

    <h2 class="text-xl font-bold mb-6">Panel de Configuración</h2>

    <!-- ▬▬▬ INFORMACIÓN GENERAL ▬▬▬ -->
    <div class="mb-10">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Información general</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <div>
                <label class="font-semibold">Nombre del cine:</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg p-2 mt-1" placeholder="Cinerama">
            </div>

            <div>
                <label class="font-semibold">Correo oficial:</label>
                <input type="email" class="w-full border border-gray-300 rounded-lg p-2 mt-1" placeholder="contacto@cinerama.com">
            </div>

            <div>
                <label class="font-semibold">Teléfono:</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg p-2 mt-1" placeholder="+51 999 999 999">
            </div>

            <div>
                <label class="font-semibold">Dirección:</label>
                <input type="text" class="w-full border border-gray-300 rounded-lg p-2 mt-1" placeholder="Av. Principal 123 - Arequipa">
            </div>
        </div>
    </div>


    <!-- ▬▬▬ PREFERENCIAS ▬▬▬ -->
    <div class="mb-10">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Preferencias del sistema</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="font-semibold">Moneda del sistema:</label>
                <select class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                    <option>Soles (S/)</option>
                    <option>Dólares ($)</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Zona horaria:</label>
                <select class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                    <option>America/Lima (GMT-5)</option>
                    <option>UTC</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Tema del panel:</label>
                <select class="w-full border border-gray-300 rounded-lg p-2 mt-1">
                    <option>Oscuro (Dark)</option>
                    <option>Claro (Light)</option>
                </select>
            </div>

            <div>
                <label class="font-semibold">Cantidad máxima de butacas por usuario:</label>
                <input type="number" class="w-full border border-gray-300 rounded-lg p-2 mt-1" placeholder="6">
            </div>
        </div>
    </div>


    <!-- ▬▬▬ PRECIOS POR DEFECTO ▬▬▬ -->
    <div class="mb-10">
        <h3 class="text-lg font-semibold text-gray-800 mb-3">Precios por defecto</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="font-semibold">Precio General 2D:</label>
                <input type="number" class="w-full border border-gray-300 rounded-lg p-2 mt-1" placeholder="15">
            </div>

            <div>
                <label class="font-semibold">Precio Niño 2D:</label>
                <input type="number" class="w-full border border-gray-300 rounded-lg p-2 mt-1" placeholder="12">
            </div>

            <div>
                <label class="font-semibold">Precio Adulto Mayor 2D:</label>
                <input type="number" class="w-full border border-gray-300 rounded-lg p-2 mt-1" placeholder="10">
            </div>

            <div>
                <label class="font-semibold">Precio Socio 2D:</label>
                <input type="number" class="w-full border border-gray-300 rounded-lg p-2 mt-1" placeholder="11">
            </div>
        </div>
    </div>


    <!-- ▬▬▬ BOTÓN ▬▬▬ -->
    <div class="text-right mt-8">
        <button 
            class="bg-yellow-500 hover:bg-yellow-400 text-black px-6 py-2 rounded-lg font-bold shadow">
            Guardar cambios
        </button>
    </div>

</div>

@endsection
