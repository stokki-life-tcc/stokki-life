<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('dashboard.perfil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'telefone' => 'nullable|string|max:50',
            'email' => 'required|email',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar_path'] = $path;
        }

        $user->update($data);

        return redirect()->route('perfil.edit')->with('success', 'Perfil atualizado com sucesso!');
    }
}
