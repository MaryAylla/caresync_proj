@extends('layouts.app')

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="fw-bold text-secondary mb-4">
                <i class="bi bi-calendar-heart text-primary me-2"></i> Nova Data Especial
            </h3>

            <div class="card border-0 shadow-sm border-top border-primary border-3">
                <div class="card-body p-4">
                    <form action="/special-dates" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Descrição do Evento ou Exame</label>
                            <input type="text" name="title" class="form-control"
                                placeholder="Ex: Check-up Cardiológico, Aniversário..." required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Data do Evento</label>
                            <input type="date" name="event_date" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Categoria</label>
                            <select name="category" class="form-control">
                                <option value="Aniversário">Aniversário</option>
                                <option value="Exame">Exame Periódico</option>
                                <option value="Outros">Outros</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold">Salvar Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection