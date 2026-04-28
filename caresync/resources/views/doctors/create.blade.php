@extends('layouts.app')

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-secondary">
                    <i class="bi bi-person-badge text-info me-2"></i> Cadastrar Novo Médico
                </h3>
                <a href="/appointments/create" class="btn btn-outline-secondary btn-sm">Voltar para o Agendamento</a>
            </div>

            <div class="card border-0 shadow-sm border-top border-info border-3">
                <div class="card-body p-4">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/doctors" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold text-dark">Especialidade</label>
                            <select name="specialty" class="form-control" required>
                                <option value="" disabled selected>Escolha uma especialidade...</option>
                                @foreach($specialties as $specialty)
                                    <option value="{{ $specialty }}">{{ $specialty }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="specialty" class="form-label fw-bold">Especialidade (Opcional)</label>
                            <input type="text" class="form-control" id="specialty" name="specialty"
                                value="{{ old('specialty') }}" placeholder="Ex: Cardiologista, Clínico Geral, Dentista...">
                        </div>

                        <button type="submit" class="btn btn-info text-white w-100 fw-bold py-2 shadow-sm">
                            <i class="bi bi-save me-1"></i> Salvar Profissional
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection