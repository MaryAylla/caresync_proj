@extends('layouts.app')

@section('conteudo')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-secondary">
                <i class="bi bi-person-badge text-primary me-2"></i> Editar Médico
            </h3>
            <a href="/doctors" class="btn btn-outline-secondary btn-sm">Voltar</a>
        </div>

        <div class="card card-care card-care-highlight border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="/doctors/{{ $doctor->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nome do Médico</label>
                        <input type="text" name="name" class="form-control" value="{{ $doctor->name }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Especialidade</label>
                        <select name="specialty" class="form-control" required>
                            @foreach($specialties as $specialty)
                                <option value="{{ $specialty }}" {{ $doctor->specialty == $specialty ? 'selected' : '' }}>
                                    {{ $specialty }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-care-primary w-100 fw-bold py-2">
                        <i class="bi bi-save me-1"></i> Salvar Alterações
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection