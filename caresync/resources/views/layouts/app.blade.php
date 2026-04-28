<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareSync - Gestão de Saúde</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/"><i class="bi bi-heart-pulse"></i> CareSync</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/appointments/create">Agendar Consulta</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/appointments">Minhas Consultas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/medications">Meus Medicamentos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/doctors">Meus Médicos</a>
                        </li>
                        <li class="nav-item">
                            <span class="nav-link text-white fw-light">Olá, <strong>{{ Auth::user()->name }}</strong></span>
                        </li>
                        <li class="nav-item">
                            <form action="/logout" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link"
                                    style="display: inline; cursor: pointer;">Sair</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light btn-sm mt-1 ms-lg-2" href="/register">Cadastrar-se</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-5">
        @yield('conteudo')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <footer class="mt-auto py-4 text-center border-top"
        style="background-color: #ffffff90; backdrop-filter: blur(5px);">
        <div class="container">
            <p class="mb-1 text-muted small fw-medium">
                <i class="bi bi-heart-pulse-fill text-primary"></i>
                Projeto desenvolvido por Maryanna Áylla — 3º Ano E.E.E.P. Dr. Napoleão Neves da Luz
            </p>
            <p class="mb-0 text-muted" style="font-size: 0.75rem;">
                &copy; {{ date('Y') }} CareSync. Cuidando de você com tecnologia e propósito.
            </p>
        </div>
    </footer>
</body>

</html>