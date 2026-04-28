@extends('layouts.app')

@section('conteudo')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-secondary">
                <i class="bi bi-person-lines-fill text-primary me-2"></i> Meus Médicos
            </h3>
            <a href="/doctors/create" class="btn btn-care-primary shadow-sm">
                <i class="bi bi-plus-lg me-1"></i> Novo Médico
            </a>
            <a href="/" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                <i class="bi bi-arrow-left me-1"></i> Voltar ao Dashboard
            </a>
        </div>

        @if(session('sucesso'))
            <div class="alert alert-success border-0 shadow-sm mb-4"
                style="background-color: var(--care-accent-green); color: var(--care-dark);">
                {{ session('sucesso') }}
            </div>
        @endif

        <div class="row g-4">
            @forelse($doctors as $doctor)
                <div class="col-md-4">
                    <div class="card card-care h-100">
                        <div class="card-body p-4 d-flex flex-column text-center">
                            <div class="mb-3">
                                <i class="bi bi-person-badge-fill fs-1 text-primary opacity-50"></i>
                            </div>
                            <h5 class="fw-bold text-dark mb-1">{{ $doctor->name }}</h5>
                            <p class="text-muted small mb-4">{{ $doctor->specialty }}</p>

                            <div class="mt-auto d-flex gap-2 justify-content-center">
                                <a href="/doctors/{{ $doctor->id }}/edit" class="btn btn-sm btn-care-secondary px-3">
                                    <i class="bi bi-pencil-fill me-1"></i> Editar
                                </a>

                                <form action="/doctors/{{ $doctor->id }}" method="POST"
                                    onsubmit="return confirm('Deseja realmente remover este profissional?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger px-3">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted">Você ainda não cadastrou nenhum médico.</p>
                    <a href="/doctors/create" class="text-primary fw-bold">Cadastrar o primeiro agora</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection