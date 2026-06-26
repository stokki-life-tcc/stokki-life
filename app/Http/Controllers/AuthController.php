<?php
/* Fazendo comentários sobre criar e cadastrar uma conta */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Irá direcionar para a página de fazer login
    public function showLogin()
    {
        return view('auth.login');
    }

    // se o usuário cadastrou a senha e o email para fazer login, terá acesso ao dashboard.
    // caso não tenha cadastrado, será impedido de fazer login.
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas']);
    }


    // página de registrar conta.
    public function showRegister()
    {
        return view('auth.register');
    }


    /* Uma database em que o usuário cadastra o nome, email e senha. */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Conta criada com sucesso!');
    }
}
