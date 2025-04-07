<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function editarPerfil()
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        return view('editar-perfil', compact('usuario')); // Retornar la vista con los datos del usuario
    }
    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user(); // Obtener usuario autenticado
        
        $request->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,' . $usuario->id,
        ]);

        $usuario->update([
            'name' => $request->input('name'),
            'apellido' => $request->input('apellido'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('editar-perfil')->with('success', 'Perfil actualizado correctamente.');
    }
    public function home(){
        $user = Auth::user();
        return view('home', compact('user'));
    }
}
