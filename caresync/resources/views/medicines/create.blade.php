@extends('layouts.app')

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="fw-bold text-secondary mb-4">
                <i class="bi bi-plus-circle text-danger me-2"></i> Adicionar ao Meu Catálogo
            </h3>

            <div class="card border-0 shadow-sm border-top border-danger border-3">
                <div class="card-body p-4">
                    <form action="/medicines" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Nome do Medicamento</label>
                            <input type="text" name="name" class="form-control" placeholder="Ex: Dipirona" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold">Dosagem Padrão</label>
                            <input type="text" name="dosage" class="form-control" placeholder="Ex: 500mg" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-bold">Salvar no Catálogo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection