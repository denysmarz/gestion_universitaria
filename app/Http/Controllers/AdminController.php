<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        $user = Auth::user();
        return view('admin', compact('usuarios', 'user'));
    }
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('editar-usuario', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'area' => $request->input('area'),
        ]);

        return redirect()->route('admin')->with('success', 'Usuario actualizado correctamente.');
    }
    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin')->with('success', 'Usuario eliminado correctamente.');
    }
    public function home(){
        $user = Auth::user();
        return view('home', compact('user'));
    }
}
