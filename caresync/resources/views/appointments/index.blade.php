@extends('layouts.app')

@section('conteudo')
    <div class="row mb-4 align-items-center">
        <div class="col-md-8">
            <h2 class="fw-bold text-secondary">Minhas Consultas</h2>
            <p class="text-muted">Histórico e agendamentos futuros.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="/appointments/create" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-lg"></i> Novo Agendamento
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            @if($appointments->isEmpty())
                <div class="p-5 text-center">
                    <i class="bi bi-calendar-x text-muted" style="font-size: 3rem;"></i>
                    <h5 class="mt-3 text-muted">Nenhuma consulta encontrada</h5>
                    <p class="text-muted mb-0">Você ainda não possui consultas cadastradas no sistema.</p>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Data e Hora</th>
                                <th>Especialidade / Médico</th>
                                <th>Observações</th>
                                <th class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">
                                        {{ \Carbon\Carbon::parse($appointment->appointment_at)->format('d/m/Y \à\s H:i') }}
                                    </td>
                                    <td class="fw-bold">
                                        {{ $appointment->doctor->name }}
                                        <br>
                                        <span
                                            class="text-muted small fw-normal">{{ $appointment->doctor->specialty ?? 'Clínico Geral' }}</span>
                                    </td>
                                    <td class="text-muted small">
                                        {{ $appointment->description ?? 'Sem observações' }}
                                    </td>
                                    <td class="text-end pe-4">
                                        <form action="/appointments/{{ $appointment->id }}" method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja cancelar esta consulta?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                                <i class="bi bi-trash"></i> Cancelar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
    </div>
@endsection