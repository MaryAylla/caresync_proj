@extends('layouts.app')

@section('conteudo')
<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-secondary">
            <i class="bi bi-capsule text-primary me-2"></i> Novo Lembrete de Medicamento
        </h3>
        <a href="/" class="btn btn-outline-primary btn-sm rounded-pill px-3">
            <i class="bi bi-arrow-left me-1"></i> Voltar ao Dashboard
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-care card-care-highlight border-0 shadow-sm">
                <div class="card-body p-4">
                    
                    <form action="/medications" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">Medicamento</label>
                            <select name="medicine_id" class="form-control" required>
                                <option value="" disabled selected>Escolha o remédio...</option>
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}">{{ $medicine->name }}</option>
                                @endforeach
                            </select>
                            <a href="/medicines/create" class="small text-primary fw-bold text-decoration-none">
                                <i class="bi bi-plus-circle"></i> Não está na lista? Cadastre no catálogo.
                            </a>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Dosagem / Instruções</label>
                            <input type="text" name="dosage" class="form-control" placeholder="Ex: 500mg, 1 comprimido, 20 gotas...">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Data de Início</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Hora da 1ª Dose</label>
                                <input type="time" name="time" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Frequência</label>
                                <select name="frequency_hours" class="form-control" required>
                                    <option value="0">Dose Única</option>
                                    <option value="4">De 4 em 4 horas</option>
                                    <option value="6">De 6 em 6 horas</option>
                                    <option value="8" selected>De 8 em 8 horas</option>
                                    <option value="12">De 12 em 12 horas</option>
                                    <option value="24">Uma vez ao dia (24h)</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Duração (Dias)</label>
                                <input type="number" name="duration_days" class="form-control" value="1" min="1" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-care-primary w-100 fw-bold py-2 shadow-sm">
                                <i class="bi bi-check2-circle me-1"></i> Agendar Tratamento
                            </button>
                        </div>
                    </form>

                </div>
            </div>
            
            <div class="text-center mt-4">
                <p class="text-muted small">
                    <i class="bi bi-info-circle"></i> O CareSync calculará automaticamente as próximas doses com base na frequência escolhida.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection