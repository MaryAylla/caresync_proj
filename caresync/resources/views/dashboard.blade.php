@extends('layouts.app')

@section('conteudo')

    <div class="care-hero-banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 text-center text-md-start">
                    <h1 class="display-5 fw-bold text-dark mb-2">Olá, {{ Auth::user()->name }}! <span class="wave">👋</span>
                    </h1>
                    <p class="fs-5 mb-4 text-muted">Cuidando de você com tecnologia e propósito.</p>

                    <a href="/appointments/create" class="btn btn-care-primary btn-lg shadow-sm px-4 py-2"
                        style="border-radius: 50px;">
                        <i class="bi bi-plus-lg me-1"></i> Novo Agendamento
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="row g-4 mb-5">

            <div class="col-md-6">
                <div class="card card-care card-care-highlight h-100">
                    <div class="card-body p-4 d-flex flex-column">

                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('img/medica.png') }}" alt="Médica Fofa 3D"
                                class="img-fofa-card me-3 shadow-sm">
                            <h5 class="card-title fw-bold text-dark mb-0">Sua Próxima Consulta</h5>
                        </div>

                        <hr class="text-muted opacity-25">

                        @if($nextAppointment)
                            <div class="flex-grow-1 p-3 rounded mb-3" style="background-color: var(--care-bg);">
                                <h6 class="fw-bold text-dark mb-1">{{ $nextAppointment->doctor->name }}
                                    @if($nextAppointment->doctor->specialty)
                                        <span
                                            class="text-muted small fs-7 fw-normal">({{ $nextAppointment->doctor->specialty }})</span>
                                    @endif
                                </h6>
                                <p class="text-primary mb-0 small fw-bold">
                                    <i class="bi bi-clock-fill me-1"></i>
                                    {{ \Carbon\Carbon::parse($nextAppointment->appointment_at)->format('d/m/Y \à\s H:i') }}
                                </p>
                            </div>

                            <div class="row g-2 mt-auto">
                                <div class="col-6">
                                    <a href="/appointments/{{ $nextAppointment->id }}/edit"
                                        class="btn btn-care-primary w-100 btn-sm py-2">Reagendar</a>
                                </div>
                                <div class="col-6">
                                    <a href="/appointments" class="btn btn-care-secondary w-100 btn-sm py-2">Ver Detalhes</a>
                                </div>
                            </div>
                        @else
                            <div class="flex-grow-1 text-center py-4">
                                <p class="text-muted small">Nenhuma consulta agendada.</p>
                            </div>
                            <div class="mt-auto">
                                <a href="/appointments/create" class="btn btn-care-primary w-100 btn-sm py-2">Nova Consulta</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-care card-care-highlight h-100">
                    <div class="card-body p-4 d-flex flex-column">

                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ asset('img/remedio.png') }}" alt="Comprimido Fofo 3D"
                                class="img-fofa-card me-3 shadow-sm">
                            <h5 class="card-title fw-bold text-dark mb-0">Sua Próxima Dose</h5>
                        </div>

                        <hr class="text-muted opacity-25">

                        @if($nextMedication)
                            <div class="flex-grow-1 p-3 rounded mb-3" style="background-color: var(--care-bg);">

                                <h6 class="fw-bold text-dark mb-1 d-flex align-items-center">
                                    <form action="/medications/{{ $nextMedication->id }}/taken" method="POST"
                                        class="m-0 p-0 me-2">
                                        @csrf
                                        @method('PATCH')
                                        <input class="form-check-input" type="checkbox" onchange="this.form.submit()"
                                            style="cursor: pointer; border-color: var(--care-primary); width: 1.2rem; height: 1.2rem;">
                                    </form>
                                    {{ $nextMedication->medicine->name }}
                                </h6>

                                <p class="text-danger mb-0 small fw-bold">
                                    <i class="bi bi-alarm-fill me-1"></i>
                                    {{ \Carbon\Carbon::parse($nextMedication->next_dose_at)->format('H:i') }}
                                </p>

                                @if($nextMedication->dosage)
                                    <p class="small text-secondary mt-1 mb-0 pt-2 border-top border-danger border-opacity-10">
                                        <i class="bi bi-info-circle"></i> Dose: {{ $nextMedication->dosage }}
                                    </p>
                                @endif

                                @if($nextMedication->frequency_hours > 0)
                                    @php
                                        $totalDoses = ($nextMedication->duration_days * 24) / $nextMedication->frequency_hours;
                                        $dosesFaltam = max(0, $totalDoses - $nextMedication->doses_taken);
                                        $dataFim = \Carbon\Carbon::parse($nextMedication->created_at)->addDays($nextMedication->duration_days);
                                        $diasRestantes = max(0, ceil(now()->floatDiffInDays($dataFim, false)));
                                        $porcentagem = ($nextMedication->doses_taken / $totalDoses) * 100;
                                    @endphp

                                    <div class="mt-2 pt-2 border-top border-danger border-opacity-10">
                                        <div class="d-flex justify-content-between small text-muted mb-1"
                                            style="font-size: 0.8rem;">
                                            <span>Faltam <strong>{{ (int) $dosesFaltam }}</strong> doses</span>
                                            <span><strong>{{ (int) $diasRestantes }}</strong> dias restantes</span>
                                        </div>
                                        <div class="progress rounded-pill shadow-sm"
                                            style="height: 6px; background-color: var(--care-secondary);">
                                            <div class="progress-bar rounded-pill"
                                                style="width: {{ $porcentagem }}%; background-color: var(--care-primary);"></div>
                                        </div>
                                    </div>
                                @else
                                    <p class="small text-muted mt-2 pt-2 mb-0 border-top border-danger border-opacity-10">
                                        <i class="bi bi-lightning-charge-fill text-warning"></i> Tratamento de Dose Única
                                    </p>
                                @endif
                            </div>

                            <div class="row g-2 mt-auto">
                                <div class="col-6">
                                    <a href="/medications/create" class="btn btn-care-primary w-100 btn-sm py-2">Novo
                                        Registro</a>
                                </div>
                                <div class="col-6">
                                    <a href="/medications" class="btn btn-care-secondary w-100 btn-sm py-2">Ver Todos</a>
                                </div>
                            </div>
                        @else
                            <div class="flex-grow-1 text-center py-4">
                                <p class="text-muted small">Nenhum lembrete para as próximas horas.</p>
                            </div>
                            <div class="mt-auto">
                                <a href="/medications/create" class="btn btn-care-primary w-100 btn-sm py-2">Novo Lembrete</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
        <h4 id="jornada" class="section-jornada-title fs-4">Sua Jornada de Saúde</h4>

        <div class="row g-4 mb-5">

            <div class="col-lg-4 col-md-6">
                <div class="card card-care h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar-check icon-jornada"></i>
                                <h6 class="card-title fw-bold text-dark mb-0">Verificações</h6>
                            </div>
                            <a href="/special-dates/create" class="btn btn-sm btn-outline-primary border-0">
                                <i class="bi bi-plus-circle-fill fs-5"></i>
                            </a>
                        </div>

                        <hr class="text-muted opacity-25 mt-0">

                        <div class="flex-grow-1 p-3 rounded" style="background-color: var(--care-bg);">
                            <ul class="list-unstyled mb-0 small">
                                @forelse($checkups as $checkup)
                                    <li class="d-flex justify-content-between mb-2 pb-2 border-bottom border-light">
                                        <span class="fw-medium text-truncate pe-2">{{ $checkup->title }}</span>
                                        <span
                                            class="text-primary fw-bold">{{ \Carbon\Carbon::parse($checkup->event_date)->format('d M') }}</span>
                                    </li>
                                @empty
                                    <li class="text-center text-muted py-2">
                                        Tudo em dia! <br>Nenhum exame próximo.
                                    </li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card card-care h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-heart-pulse icon-jornada"></i>
                            <h6 class="card-title fw-bold text-dark mb-0">Sua Adesão</h6>
                        </div>

                        <hr class="text-muted opacity-25 mt-0">

                        <div class="flex-grow-1 text-center d-flex flex-column justify-content-center">
                            <div class="chart-adesao mb-3 mx-auto">
                                <div class="chart-adesao-inner">
                                    95%
                                </div>
                            </div>
                            <p class="text-muted small mb-0">Ótimo trabalho este mês!</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card card-care h-100" style="background: linear-gradient(145deg, var(--care-bg), #ffffff);">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-lightbulb icon-jornada text-warning"></i>
                            <h6 class="card-title fw-bold text-dark mb-0">Dica do CareSync</h6>
                        </div>

                        <hr class="text-muted opacity-25 mt-0">

                        <div class="flex-grow-1 d-flex align-items-center justify-content-center p-3 rounded"
                            style="background-color: rgba(149, 117, 205, 0.1);">
                            <p class="mb-0 text-center fw-medium text-dark" style="font-size: 0.95rem; line-height: 1.5;">
                                📢 {{ $dicaDoDia ?? 'Beba água! A hidratação ajuda a manter a sua energia em alta.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card card-care h-100" style="background: linear-gradient(145deg, #e0f7fa, #ffffff);">
                    <div class="card-body p-4 d-flex flex-column text-center">
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <i class="bi bi-droplet-fill text-info fs-3 me-2"></i>
                            <h6 class="card-title fw-bold text-dark mb-0">Hidratação</h6>
                        </div>

                        <hr class="text-muted opacity-25 mt-0">

                        <div class="flex-grow-1 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold text-info mb-0">{{ $waterDrunk }} <small class="fs-6 text-muted">/
                                    {{ $waterGoal }}ml</small></h3>
                            <p class="small text-muted mb-3">Meta Diária</p>

                            <div class="progress rounded-pill mb-3" style="height: 12px; background-color: #e0f2f1;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    style="width: {{ $waterPercentage }}%; background-color: #26c6da;"></div>
                            </div>

                            <form action="/water/add" method="POST">
                                @csrf
                                <button type="submit"
                                    class="btn btn-sm btn-info text-white fw-bold w-100 rounded-pill shadow-sm">
                                    <i class="bi bi-plus-lg"></i> Beber 250ml
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection