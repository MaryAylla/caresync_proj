<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    public function create()
    {
        $doctors = Doctor::where('user_id', Auth::id())->orderBy('name')->get();

        return view('appointments.create', compact('doctors'));
    }

    public function store(Request $request)
{
    $request->validate([
        'doctor_id' => 'required|exists:doctors,id',
        'date' => 'required|date',
        'time' => 'required',
        'description' => 'nullable|string',
    ]);

    $appointment_at = \Carbon\Carbon::parse($request->date . ' ' . $request->time);

    \App\Models\Appointment::create([
        'user_id' => \Auth::id(),
        'doctor_id' => $request->doctor_id,
        'appointment_at' => $appointment_at,
        'description' => $request->description,
    ]);

    return redirect('/')->with('sucesso', 'Consulta agendada com sucesso!');
}
    // Lista todas as consultas do usuário logado
    public function index()
    {
        // Busca todas as consultas, ordenadas da mais próxima para a mais distante
        $appointments = Appointment::where('user_id', Auth::id())
            ->orderBy('appointment_at', 'asc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }
    // Cancela uma consulta
    public function destroy($id)
    {
        // Encontra a consulta específica pelo ID e verifica se pertence ao usuário logado
        $appointment = Appointment::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Deleta do banco de dados
        $appointment->delete();

        // Redireciona de volta para a lista com mensagem de sucesso
        return redirect('/appointments')->with('sucesso', 'Consulta cancelada com sucesso!');
    }

    public function edit($id)
    {
        $appointment = \App\Models\Appointment::where('id', $id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();
        $doctors = \App\Models\Doctor::where('user_id', \Illuminate\Support\Facades\Auth::id())->orderBy('name')->get();

        return view('appointments.edit', compact('appointment', 'doctors'));
    }

    // Salva a nova data no banco
    public function update(\Illuminate\Http\Request $request, $id)
    {
        $appointment = \App\Models\Appointment::where('id', $id)->where('user_id', \Illuminate\Support\Facades\Auth::id())->firstOrFail();

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
