<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;

class MedicineController extends Controller
{
    public function create()
    {
        return view('medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'dosage' => 'required|string|max:100',
        ]);

        Medicine::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'dosage' => $request->dosage,
        ]);

        // Redireciona direto para a tela de criar o lembrete/alarme
        return redirect('/medications/create')->with('sucesso', 'Remédio adicionado ao seu catálogo!');
    }
}