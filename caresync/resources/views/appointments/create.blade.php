@extends('layouts.app')

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-secondary">
                    <i class="bi bi-calendar-plus text-primary me-2"></i> Agendar Nova Consulta
                </h3>
                <a href="/" class="btn btn-outline-secondary btn-sm">Voltar ao Dashboard</a>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Ops!</strong> Verifique os erros abaixo antes de prosseguir:
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card card-care card-care-highlight border-0 shadow-sm">

                        <form action="/appointments" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-bold">Com qual médico?</label>
                                <select name="doctor_id" class="form-control" required>
                                    <option value="" disabled selected>Selecione um médico...</option>
                                    @foreach($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }} ({{ $doctor->specialty }})
                                        </option>
                                    @endforeach
                                </select>
                                <a href="/doctors/create" class="small text-primary fw-bold text-decoration-none">
                                    <i class="bi bi-plus-circle"></i> Não está na lista? Cadastre agora.
                                </a>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Dia da Consulta</label>
                                    <input type="date" name="date" class="form-control" required>
                                    <small class="text-muted">Clique no ícone do calendário para escolher.</small>

                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Hora</label>
                                    <input type="time" name="time" class="form-control" required>
                                    <small class="text-muted">Horário da consulta.</small>
                                </div>
                            </div>


                            <div class="mb-4">
                                <label class="form-label fw-bold"><i
                                        class="bi bi-chat-left-text text-primary me-2"></i>Anotações (Opcional)</label>
                                <textarea name="description" class="form-control border-2"
                                    style="border-color: var(--care-secondary);" rows="3"
                                    placeholder="Ex: Jejum de 8h, levar exames antigos..."></textarea>
                            </div>

                            <button type="submit" class="btn btn-care-primary w-100 fw-bold py-3 shadow">
                                Confirmar Agendamento
                            </button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
@endsection