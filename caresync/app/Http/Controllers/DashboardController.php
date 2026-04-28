<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Medication;
use Illuminate\Support\Facades\Auth;
use App\Models\SpecialDate;

class DashboardController extends Controller
{
    public function index()
    {
        $nextAppointment = \App\Models\Appointment::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->where('appointment_at', '>=', now())
            ->orderBy('appointment_at')->first();

        $nextMedication = \App\Models\Medication::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->where('next_dose_at', '>=', now())
            ->orderBy('next_dose_at')->first();

        $checkups = \App\Models\SpecialDate::where('user_id', \Illuminate\Support\Facades\Auth::id())
            ->whereIn('category', ['Exame', 'Outros'])
            ->where('event_date', '>=', now())
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        $dicas = [
            'Beba água! A hidratação ajuda a manter a sua energia em alta.',
            'Sabia que um sono regular fortalece sua imunidade? Tente dormir 7-8 horas hoje! 💤',
            'Tire 5 minutos para respirar fundo e relaxar. A sua saúde mental importa. 🧘‍♀️',
            'Uma caminhada de 15 minutos já melhora (e muito!) a circulação do corpo. 🚶‍♂️',
            'Lembre-se: Cuidar de si mesma não é egoísmo, é o maior ato de amor. 💜'
        ];

        // Pega uma dica aleatória da lista
        $dicaDoDia = $dicas[array_rand($dicas)];

        // CÁLCULO DA ÁGUA
    $waterGoal = Auth::user()->water_goal;
    $waterDrunk = \App\Models\WaterLog::where('user_id', Auth::id())
                    ->whereDate('created_at', now())
                    ->sum('amount');
    
    $waterPercentage = min(100, ($waterDrunk / $waterGoal) * 100);

    return view('dashboard', compact(
        'nextAppointment', 'nextMedication', 'checkups', 'dicaDoDia', 
        'waterGoal', 'waterDrunk', 'waterPercentage'
    ));
}

    // Busca os dados antigos e abre a tela de edição
    public function edit($id)
    {
        $appointment = Appointment::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $doctors = \App\Models\Doctor::where('user_id', Auth::id())->orderBy('name')->get();

        return view('appointments.edit', compact('appointment', 'doctors'));
    }

    // Salva a nova data no banco
    public function update(Request $request, $id)
    {
        $appointment = Appointment::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_at' => 'required|date',
            'description' => 'nullable|string',
        ]);

        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'appointment_at' => $request->appointment_at,
            'description' => $request->description,
        ]);

        return redirect('/')->with('sucesso', 'Consulta reagendada com sucesso!');
    }
}