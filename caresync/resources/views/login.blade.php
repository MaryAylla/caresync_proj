@extends('layouts.app')

@section('conteudo')
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card border-0 shadow-sm mt-5">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary">Bem-vindo de volta</h3>
                        <p class="text-muted">Acesse o CareSync</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="/login" method="POST">
                        @csrf <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                                required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Entrar</button>
                    </form>

                    <div class="text-center mt-3">
                        <small class="text-muted">Ainda não tem conta? <a href="/register"
                                class="text-decoration-none">Cadastre-se aqui</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection