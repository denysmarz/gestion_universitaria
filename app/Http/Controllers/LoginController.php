<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function register(Request $request){
        $user = new User();
        $user ->name = $request->input('name');
        $user ->apellido = $request->input('apellido');
        $user ->email = $request->input('email');
        $user ->password = Hash::make($request->input('password'));
        $user ->area = $request->input('area');
        $user->save();
        Auth::login($user);
        return redirect()->route('home');

    }
    public function login(Request $request)
    {
        $credentials = [
            "email" => $request->input('email'),
            "password" => $request->input('password')
        ];

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            // Redirigir según el rol del usuario autenticado
            $user = Auth::user();
            if ($user->rol === 'admin') {
                // mandar al admin la lista de usuarios
                $usuarios = User::all();
                return redirect()->route('admin'); // Redirige a home.blade.php
            }

            return redirect()->route('home'); // Redirige a home.blade.php
        }

        return redirect()->route('login')->with('error', 'Credenciales incorrectas');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function registerAdmin(Request $request){
        $user = new User();
        $user->name = $request->input('name');
        $user->apellido = $request->input('apellido');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->area = $request->input('area');
        $user->save();
    
        return response()->json(['message' => 'Usuario registrado exitosamente'], 200);
    }
    
}
