<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log; // 👈 Importante: agrega Log

class ContactController extends Controller
{
    public function send(Request $request)
    {
        // 🟢 Log inicial para confirmar recepción
        Log::info('📩 Formulario recibido en ContactController', $request->all());

        // ✅ Validar los campos del formulario
        $validated = $request->validate([
            'empresa' => 'required|string|max:255',
            'correo' => 'required|email',
            'telefono' => 'required|string|max:20',
            'ciudad' => 'required|string|max:100',
            'mensaje' => 'required|string|max:1000',
        ]);

        // ✅ Preparar los datos
        $data = [
            'empresa' => $validated['empresa'],
            'correo' => $validated['correo'],
            'telefono' => $validated['telefono'],
            'ciudad' => $validated['ciudad'],
            'mensaje' => $validated['mensaje'],
        ];

        try {
            // ✅ 1. Enviar correo a la empresa
            Mail::send('emails.contacto', $data, function ($message) use ($validated) {
                $message->from('cineramaprueba@gmail.com', 'Cinerama');
                $message->to('cineramaprueba@gmail.com', 'Cinerama')
                        ->subject('📩 Nueva solicitud desde el formulario corporativo');
            });

            // ✅ 2. Enviar correo de confirmación al cliente
            Mail::send('emails.confirmacion', $data, function ($message) use ($validated) {
                $message->from('cineramaprueba@gmail.com', 'Cinerama');
                $message->to($validated['correo'], $validated['empresa'])
                        ->subject('🎬 Confirmación de contacto - Cinerama');
            });

            // 🟢 Log final confirmando envío exitoso
            Log::info('✅ Correo enviado correctamente');

            // ✅ 3. Mostrar mensaje de éxito
            return back()->with('success', '✅ Tu mensaje ha sido enviado con éxito. También hemos enviado una confirmación a tu correo.');

        } catch (\Exception $e) {
            // ⚠️ Mostrar error (temporalmente para depurar)
            Log::error('❌ Error al enviar el correo: ' . $e->getMessage());
            return back()->with('success', '❌ Error al enviar el correo: ' . $e->getMessage());
        }
    }
}



