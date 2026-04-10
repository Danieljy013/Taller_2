<?php

namespace App\Http\Controllers;

use App\Models\Contactanos;
use App\Models\Postulacion;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    // 📩 Guardar mensajes de contacto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email',
            'mensaje' => 'required'
        ]);

        Contactanos::create($request->only([
            'nombre',
            'email',
            'mensaje'
        ]));

        return redirect()->back()->with('success', 'Mensaje enviado correctamente');
    }

    // 🧑‍💼 Panel admin (mensajes de contacto)
    public function index()
    {
        $mensajes = Contactanos::latest()->get();
        return view('admin', compact('mensajes'));
    }

    // 🚀 Guardar postulaciones (formulario CV completo)
    public function storeOferta(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required|email',
            'edad' => 'nullable|numeric',
        ]);

        Postulacion::create($request->only([
            'nombre',
            'apellidos',
            'edad',
            'sexo',
            'email',
            'telefono',
            'departamento',
            'ciudad',
            'cargo',
            'empresa',
            'ciudad_empresa',
            'experiencia',
            'logros',
            'idiomas',
            'motivacion'
        ]));

        return redirect()->back()->with('success', 'Solicitud enviada correctamente');
    }

    public function verPostulaciones()
{
    $postulaciones = Postulacion::latest()->get();
    return view('admin_postulaciones', compact('postulaciones'));
}

}