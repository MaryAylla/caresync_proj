<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // 1. Método para EXIBIR o formulário HTML
    public function showRegister()
    {
        return view('register');
    }

    // 2. Método para PROCESSAR os dados enviados
    public function processRegister(Request $request)
    {
        // A. Validação Estrita 
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'birth_date' => 'required|date',
            'timezone' => 'required|string',
        ]);

        // B. Criação do Usuário e Criptografia da Senha
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'birth_date' => $request->birth_date,
            'timezone' => $request->timezone,
        ]);

        // C. Login Automático
        Auth::login($user);

        // D. Redirecionamento para o Dashboard
        return redirect('/')->with('sucesso', 'Conta criada com sucesso!');
    }
    // 3. Método para EXIBIR a tela de login
    public function showLogin()
    {
        return view('login');
    }

    // 4. Método para PROCESSAR o login
    public function processLogin(Request $request)
    {
        // A. Valida se o usuário preencheu os campos
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // B. Tenta fazer o login no banco de dados
        if (Auth::attempt($credentials)) {
            // Se a senha bater, regenera a sessão 
            $request->session()->regenerate();
            return redirect()->intended('/'); // Manda pro Dashboard
        }

        // C. Se errar a senha, volta com erro
        return back()->withErrors([
            'email' => 'As credenciais fornecidas estão incorretas.',
        ])->onlyInput('email');
    }

    // 5. Método para SAIR do sistema 
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}