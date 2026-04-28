<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    // A nossa lista predefinida de especialidades
    private $specialties = [
        'Alergologia', 'Cardiologia', 'Clínico Geral', 'Dermatologia', 
        'Endocrinologia', 'Gastroenterologia', 'Ginecologia', 'Neurologia', 
        'Nutrologia', 'Oftalmologia', 'Ortopedia', 'Otorrinolaringologia', 
        'Pediatria', 'Psiquiatria', 'Urologia', 'Outra'
    ];

    // Atualize a sua função CREATE atual para enviar as especialidades para a tela
    public function create()
    {
        $specialties = $this->specialties;
        return view('doctors.create', compact('specialties'));
    }

    
    public function edit($id)
    {
        $doctor = \App\Models\Doctor::where('id', $id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();
        $specialties = $this->specialties;
        
        return view('doctors.edit', compact('doctor', 'specialties'));
    }

    // SALVA A EDIÇÃO NO BANCO
    public function update(\Illuminate\Http\Request $request, $id)
    {
        $doctor = \App\Models\Doctor::where('id', $id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
        ]);

        $doctor->update($request->all());

        return redirect('/doctors')->with('sucesso', 'Dados do médico atualizados com sucesso!');
    }

    // APAGA O MÉDICO
    public function destroy($id)
    {
        $doctor = \App\Models\Doctor::where('id', $id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();
        $doctor->delete();

        return redirect('/doctors')->with('sucesso', 'Médico removido da sua lista.');
    }

    // 2. Salva o médico no banco de dados
    public function store(Request $request)
    {
        // Validação
        $request->validate([
            'name' => 'required|string|max:150',
            'specialty' => 'nullable|string|max:100',
        ]);

        // Criação no banco
        Doctor::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'specialty' => $request->specialty,
        ]);

        // Redireciona o usuário de volta para a tela de marcar consulta!
        return redirect('/appointments/create')->with('sucesso', 'Médico cadastrado com sucesso! Agora você já pode selecioná-lo na lista.');
    }
    public function index()
{
    // Busca apenas os médicos do usuário logado, em ordem alfabética
    $doctors = \App\Models\Doctor::where('user_id', \Illuminate\Support\Facades\Auth::id())
                ->orderBy('name', 'asc')
                ->get();

    // Abre a pasta doctors e o arquivo index.blade.php, enviando a variável $doctors
    return view('doctors.index', compact('doctors'));
}
}