<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\MedicationReminder;

class MedicationController extends Controller
{
    // 1. Mostra a tela de cadastro do remédio 
    public function create()
{
    // Busca os remédios do catálogo do usuário
    $medicines = \App\Models\Medicine::where('user_id', \Auth::id())->orderBy('name')->get();
    return view('medications.create', compact('medicines'));
}

    // 2. Recebe os dados e salva no banco de dados
   public function store(Request $request)
{
    $request->validate([
        'medicine_id' => 'required|exists:medicines,id',
        'dosage' => 'nullable|string',
        'date' => 'required|date',
        'time' => 'required',
        'frequency_hours' => 'required|integer|min:0',
        'duration_days' => 'required|integer|min:1',
    ]);

    // Juntando Data e Hora para o início do tratamento
    $next_dose_at = \Carbon\Carbon::parse($request->date . ' ' . $request->time);

    \App\Models\Medication::create([
        'user_id' => \Auth::id(),
        'medicine_id' => $request->medicine_id,
        'dosage' => $request->dosage,
        'next_dose_at' => $next_dose_at,
        'frequency_hours' => $request->frequency_hours,
        'duration_days' => $request->duration_days,
        'doses_taken' => 0,
    ]);

    return redirect('/')->with('sucesso', 'Tratamento registrado com sucesso!');
}

    // Lista todos os medicamentos do usuário
    public function index()
{
    $medications = \App\Models\Medication::where('user_id', \Auth::id())->get();
    return view('medications.index', compact('medications'));
}
    // Remove um medicamento do sistema
    public function taken($id)
{
    $medication = \App\Models\Medication::where('id', $id)->where('user_id', \Auth::id())->firstOrFail();
    
    // Incrementa a dose tomada
    $medication->increment('doses_taken');

    // Se for dose única, finaliza logo
    if ($medication->frequency_hours == 0) {
        $medication->delete();
        return redirect('/')->with('sucesso', 'Dose única registrada!');
    }

    // Calcula o total de doses que o tratamento deve ter
    $totalDosesDesejadas = ($medication->duration_days * 24) / $medication->frequency_hours;

    if ($medication->doses_taken >= $totalDosesDesejadas) {
        $medication->delete();
        return redirect('/')->with('sucesso', 'Tratamento concluído com sucesso! 🎉');
    }

    // Agenda a próxima dose
    $novaData = \Carbon\Carbon::parse($medication->next_dose_at)->addHours($medication->frequency_hours);
    $medication->update(['next_dose_at' => $novaData]);

    return redirect('/')->with('sucesso', "Dose registrada! ({$medication->doses_taken} de " . (int)$totalDosesDesejadas . " doses tomadas)");
}

public function destroy($id)
{
    $medication = \App\Models\Medication::where('id', $id)->where('user_id', \Auth::id())->firstOrFail();
    $medication->delete();

    return redirect('/medications')->with('sucesso', 'Medicamento removido.');
}
}