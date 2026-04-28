@extends('layouts.app')

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-secondary">
                    <i class="bi bi-calendar-event text-primary me-2"></i> Reagendar Consulta
                </h3>
                <a href="/" class="btn btn-outline-secondary btn-sm">Cancelar</a>
            </div>

            <div class="card card-care card-care-highlight border-0 shadow-sm">
                <div class="card-body p-4">

                    <form action="/appointments/{{ $appointment->id }}" method="POST">
                        @csrf
                        @method('PUT') <div class="mb-3">
                            <label class="form-label fw-bold">Médico</label>
                            <select name="doctor_id" class="form-control" required>
                                @foreach($doctors as $doctor)
                                    <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                                        {{ $doctor->name }} ({{ $doctor->specialty }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nova Data e Hora</label>
                            <input type="datetime-local" class="form-control" name="appointment_at"
                                value="{{ $appointment->appointment_at }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Observações (Opcional)</label>
                            <textarea class="form-control" name="description"
                                rows="2">{{ $appointment->description }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-care-primary w-100 fw-bold py-2">
                            <i class="bi bi-save me-1"></i> Confirmar Novo Horário
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection