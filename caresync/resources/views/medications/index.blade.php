@extends('layouts.app')

@section('conteudo')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-secondary">💊 Meus Medicamentos</h3>
        
        <a href="/medications/create" class="btn btn-care-primary">Novo Registro</a>
        
    </div>

    <div class="row g-4">
        @forelse($medications as $med)
            @php
                $totalDoses = ($med->frequency_hours > 0) ? ($med->duration_days * 24) / $med->frequency_hours : 1;
                $porcentagem = ($med->doses_taken / $totalDoses) * 100;
            @endphp
            <div class="col-md-6">
                <div class="card card-care shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between">
                            <h5 class="fw-bold text-dark">{{ $med->medicine->name }}</h5>
                            <form action="/medications/{{ $med->id }}" method="POST" onsubmit="return confirm('Excluir este tratamento?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                        
                        <p class="text-muted small mb-3">
                            {{ $med->frequency_hours }}h em {{ $med->frequency_hours }}h | {{ $med->duration_days }} dias
                        </p>

                        <div class="progress mb-2" style="height: 10px; background-color: var(--care-secondary);">
                            <div class="progress-bar" style="width: {{ $porcentagem }}%; background-color: var(--care-primary);"></div>
                        </div>
                        <small class="text-secondary fw-bold">Doses: {{ $med->doses_taken }} / {{ (int)$totalDoses }}</small>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Nenhum medicamento ativo.</p>
        @endforelse
    </div>
</div>
<a href="/" class="btn btn-outline-primary btn-sm rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Voltar ao Dashboard
    </a>
@endsection