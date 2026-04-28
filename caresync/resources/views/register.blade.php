@extends('layouts.app')

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary">Criar Conta</h3>
                        <p class="text-muted">Junte-se ao CareSync e cuide da sua saúde.</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/register" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="birth_date" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date"
                                    value="{{ old('birth_date') }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="timezone" class="form-label">Fuso Horário</label>
                            <select class="form-select" id="timezone" name="timezone">
                                <option value="America/Fortaleza">America/Fortaleza (Padrão)</option>
                                <option value="America/Sao_Paulo">America/São Paulo</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Cadastrar-se</button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">Já tem uma conta? <a href="/login" class="text-decoration-none">Faça
                                login</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection